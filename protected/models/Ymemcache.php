<?php
class Ymemcache extends CMemCache{
    private $pano_xml_prefix = 'pano_xml_';
    private $img_no_prefix = 'img_no_';
    private $img_id_prefix = 'img_id_';
    public function __construct(){
        return parent::init();
    }
    /**
     *
     */
    public function get_pano_xml_key($scene_id){
        return $this->pano_xml_prefix.$scene_id;
    }
    public function get_img_no_key($no){
        if(!$no){
            return false;
        }
        return $this->img_no_prefix.$no;
    }
    public function get_img_id_key($id){
        if(!$id){
            return false;
        }
        return $this->img_id_prefix.$id;
    }
    public function get_mem_data($key){
        return parent::getValue($key);
    }
    public function set_mem_data($key, $value, $expire){
        return parent::setValue($key, $value, $expire);
    }
    public function rm_mem_datas($key){
        return parent::deleteValue($key);
    }

}