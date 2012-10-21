<?php
Yii::import('application.extensions.image.Image');
class ImageContent {
	public $quality = 90;
	public $sharpen = 5;
	public $water = false;

    private function show_pics($pic_datas){
        if(!$pic_datas || !$pic_datas['path'] || !$pic_datas['draw']){
            return false;
        }
        $img = @$pic_datas['create']($pic_datas['path']);

        $cache_time = '31104000';
        header('Content-Type: '.$pic_datas['contentType']);
        header('Cache-Control: max-age='.$cache_time);
        header('Pragma: cache');
        $created = strtotime(date('Y-m-d',time()));
        $pic_datas['created'] = isset($pic_datas['created']) ? $pic_datas['created'] : $created;
        HttpCache::lastModified($pic_datas['created']);
        $pic_datas['md5value'] = isset($pic_datas['md5value']) ? $pic_datas['md5value'] : $pic_datas['path'];
        $pic_datas['size'] = isset($pic_datas['size']) ? $pic_datas['size'] : '';
        $etag = md5($pic_datas['md5value'].'-yiluhao'.$pic_datas['size']);
        HttpCache::etag($etag);
        HttpCache::expires($cache_time); //默认缓存一年
        //添加水印
        if($this->water){
	        $water_pic_path = 'style/img/water.png';
	        $watermark = imagecreatefrompng($water_pic_path);
	        $rand = rand(0, 8);
	        $time = substr(time(), $rand, 2);
	        $rand = rand(0, 5);
	        $ox = $time*$rand;
	        $rand = rand(0, 5);
	        $oy = $time*$rand;
	        imagecopy($img, $watermark, $ox, $oy, 0, 0, 70, 13);
        }

        $pic_datas['draw']($img);
        imagedestroy($img);
        exit();
    }
    public function get_default_img($path, $type='gif'){
        $pic_datas = array( 'type'=>$type, 'pic_content'=>'' );
        if(!is_file($path)){
            return false;
        }
        $pic_datas = $this->get_image_type($type);
        $pic_datas['path'] = $path;

        $this->show_pics($pic_datas);
    }
    /**
     * 根据file_id获取文件信息
     */
    public function get_img_content_by_id($id, $size, $suffix='', $file = ''){
        if(!$id){
            return false;
        }
        $datas = $this->get_file_info_by_id($id);
        $pic_datas = $this->get_img_info($datas, $size, $suffix, $file);
        $this->show_pics($pic_datas);
    }
    /**
     * 根据md5获取图片
     * @param unknown_type $no
     * @param unknown_type $size
     * @return boolean
     */
    public function get_img_content_by_md5file($no, $size, $suffix=''){
        if(!$no){
            return false;
        }
        $datas = $this->get_file_info_by_md5file($no);
        if(!$datas || !$datas[0]){
            return false;
        }
        $pic_datas = $this->get_img_info($datas[0], $size, $suffix);
        $this->show_pics($pic_datas);
    }

    /*
     * $id =file_id
     * $size like 200x200.jpg
     */
    public function get_img_info($datas, $size, $suffix='', $add_suffix = false){
        $pic_datas = array();
        if(!$datas){
            return false;
        }
        $pic_type = $datas->type;
        $path = $this->get_file_path($datas);
        $path_original = $path;
        if($suffix){
            $path_original = $path.$suffix.'/';
        }
        //$path .= $datas['name'];
        if($add_suffix){
            $path = $path_original;
        }
        $path_new = $path.$size;
            if(!is_file($path_new)){
                $explode_1 = explode('.', $size);
                $explode_2 = explode('x', $explode_1[0]);
                $path_original .= $datas['md5value'].'.'.$datas['type'];
                if(!is_file($path_original)){
                    return false;
                }
                $this->resize($path_original, $path_new, (int)$explode_2[0], (int)$explode_2[1]);
            }
            $path = $path_new;
        $pic_datas = $this->get_image_type($pic_type);
        $pic_datas['path'] = $path;
        $pic_datas['created'] = $datas['created'];
        $pic_datas['md5value'] = $datas['md5value'];
        $pic_datas['size'] = $size;
        return $pic_datas;
    }
    /**
     *
     */
    private function get_image_type($type){
        $image_info = array();
        switch ($type){
            case 'jpg':
                $image_info['create'] = 'imagecreatefromjpeg';
                $image_info['contentType'] = 'image/jpeg';
                $image_info['draw'] = 'imagejpeg';
                break;
            case 'jpg':
                $image_info['create'] = 'imagecreatefromgif';
                $image_info['contentType'] = 'image/gif';
                $image_info['draw'] = 'imagegif';
            case 'jpg':
                $image_info['create'] = 'imagecreatefrompng';
                $image_info['contentType'] = 'image/png';
                $image_info['draw'] = 'imagepng';
                break;
        }
        return $image_info;
    }

    /**
     * 缩小图片大小
     */
    private function resize($input, $output, $width, $height){
        $image = new Image($input);
        if($this->sharpen){
        	$image->resize($width, $height)->quality($this->quality)->sharpen($this->sharpen);
        }
        else{
        	$image->resize($width, $height)->quality($this->quality);
        }
        return $image->save($output);
    }

    private function get_file_path($datas){
        $year_month = substr($datas->folder, 0, 6);
        $day = substr($datas['folder'], -2);
        $path = Yii::app()->params['file_pic_folder'].'/'.$year_month.'/'.$day.'/'.$datas['md5value'].'/';
        return $path;
    }
    private function get_file_info_by_md5file($no){
        $memcache_obj = new Ymemcache();
        $key = $memcache_obj->get_img_no_key($no);
        if(!$datas = $memcache_obj->get_mem_data($key)){
            $file_path_db = new FilePath();
            $datas = $file_path_db->get_file_by_no($no);
            $memcache_obj->set_mem_data($key, $datas, 0);
        }
        return $datas;
    }
    private function get_file_info_by_id($id){
        $memcache_obj = new Ymemcache();
        $key = $memcache_obj->get_img_id_key($id);
        if(!$datas = $memcache_obj->get_mem_data($key)){
            $file_path_db = new FilePath();
            $datas = $file_path_db->get_by_file_id($id);
            $memcache_obj->set_mem_data($key, $datas, 0);
        }
        return $datas;
    }

}