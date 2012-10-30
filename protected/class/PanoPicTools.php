<?php
class PanoPicTools{
    public $tile_info = array('11'=>2000, '10'=>1000, '9'=>500);
    /**
     * 将文件处理成1000大小
     */
    public function resize_pano($file_path, $folder, $file_type){
        $folder_pano = $folder.'9/';
        if(!is_dir($folder_pano)){
            mkdir($folder_pano);
        }
        $folder_10 = $folder.'10/';
        if(!is_dir($folder_10)){
            mkdir($folder_10);
        }
        $image = Yii::app()->image->load($file_path);
        $width = $this->tile_info[9];
        $image->resize($width, $width)->quality(10);
        $file_path_9 = $folder_pano.$width.'x'.$width.'.'.$file_type;
        $image->save($file_path_9);

        $image = Yii::app()->image->load($file_path);
        $width = $this->tile_info[10];
        $image->resize($width, $width)->quality(85)->sharpen(5);
        //$image->resize($width, $width)->quality(90);
        $file_path_10 = $folder_10.$width.'x'.$width.'.'.$file_type;
        $image->save($file_path_10);
        //切割图片
        $this->split_img($file_path_10, $folder,$file_type);
    }
    public function get_exif_imagetype($file_path){
        if ( ( list($width, $height, $type, $attr) = getimagesize( $file_path ) ) !== false ) {
            return $type;
        }
        return false;
    }
    /**
     * 切割图片
     */
    public function split_img($src_file, $folder,$file_type){
        $maxW = $maxH = $this->tile_info[10]/2;
        if ( !function_exists( 'exif_imagetype' ) ) {
            $type = $this->get_exif_imagetype($src_file);
        }
        else{
            $type = exif_imagetype($src_file);
        }

        $support_type=array(IMAGETYPE_JPEG , IMAGETYPE_PNG , IMAGETYPE_GIF);
        //Load image
        switch($type) {
            case IMAGETYPE_JPEG :
                $src_img = imagecreatefromjpeg($src_file);
            break;
            case IMAGETYPE_PNG :
                $src_img = imagecreatefrompng($src_file);
            break;
            case IMAGETYPE_GIF :
                $src_img = imagecreatefromgif($src_file);
            break;
        }
        list($width, $height, $type, $attr) = getimagesize($src_file);
        $widthnum=ceil($width/$maxW);
        $heightnum=ceil($height/$maxH);
        $iOut = imagecreatetruecolor ($maxW,$maxH);
        for ($i=0;$i < $heightnum;$i++) {
            for ($j=0;$j < $widthnum;$j++) {
                imagecopy($iOut,$src_img,0,0,($j*$maxW),($i*$maxH),$maxW,$maxH);//复制图片的一部分
                //imagejpeg($iOut,"images/".$i."_".$j.".jpg"); //输出成0_0.jpg,0_1.jpg这样的格式
                $file_path = $folder.'10/'.$i.'x'.$j.'.'.$file_type;
                //echo $file_path.'<br>';
                $quality = 85;
                switch($type) {
                    case IMAGETYPE_JPEG :
                        imagejpeg($iOut, $file_path,$quality); // 存储图像
                    break;
                    case IMAGETYPE_PNG :
                        imagepng($iOut,$file_path,$quality);
                    break;
                    case IMAGETYPE_GIF :
                        imagegif($iOut,$file_path,$quality);
                    break;
                }
                //$image = Yii::app()->image->load($file_path);
                //$image->quality(85);
                //$image->save($file_path);
            }
        }
        imagedestroy($iOut);
    }
}