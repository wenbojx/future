<?php
Yii::import('application.extensions.image.Image');
class ImageContent {
	private function show_pics($pic_datas){
		if(!$pic_datas || !$pic_datas['path'] || !$pic_datas['draw']){
			return false;
		}
		$img = @$pic_datas['create']($pic_datas['path']);
		header('Content-Type: '.$pic_datas['contentType']);
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
    public function get_img_content_by_id($id, $size){
        if(!$id){
            return false;
        }
        $datas = $this->get_file_info_by_id($id);
        $pic_datas = $this->get_img_info($datas, $size);
        $this->show_pics($pic_datas);
    }
    /**
     * 根据md5获取图片
     * @param unknown_type $no
     * @param unknown_type $size
     * @return boolean
     */
    public function get_img_content_by_md5file($no, $size){
        if(!$no){
            return false;
        }
        $datas = $this->get_file_info_by_md5file($no);
        $pic_datas = $this->get_img_info($datas, $size);
        $this->show_pics($pic_datas);
    }

    /*
     * $id =file_id
     * $size like 200x200.jpg
     */
    public function get_img_info($datas, $size){
        $pic_datas = array();
        if(!$datas){
            return false;
        }
        $pic_type = $datas->type;
        $path = $this->analyze_path($datas);
        if(!is_file($path)){
            return false;
        }
        if($size_info = $size){
            $path_new = $this->folder.$size_info;
            if(!is_file($path_new)){
                $explode_1 = explode('.', $size_info);
                $explode_2 = explode('x', $explode_1[0]);
                $this->resize($path, $path_new, (int)$explode_2[0], (int)$explode_2[1]);
            }
            $path = $path_new;
        }
        $pic_datas = $this->get_image_type($pic_type);
        $pic_datas['path'] = $path;
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
        $image->resize($width, $height);
        return $image->save($output);
    }
    private function analyze_path($datas){
        $year_month = substr($datas->folder, 0, 6);
        $day = substr($datas->folder, -2);
        $path = Yii::app()->params['file_pic_folder'].'/'.$year_month.'/'.$day.'/'.$datas->md5value.'/';
        $this->folder = $path;
        return $path.$datas->name;
    }
    private function get_file_info_by_md5file($no){
        $file_path_db = new FilePath();
        $datas = $file_path_db->find('md5value=:md5value', array(':md5value'=>$no));
        if(!$datas){
            return false;
        }
        return $datas;
    }
    private function get_file_info_by_id($id){
        $file_path_db = new FilePath();
        $datas = $file_path_db->findByPk($id);
        if(!$datas){
            return false;
        }
        return $datas;
    }
}