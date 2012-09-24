<?php
class Ymemcache extends CMemCache{
    private $pano_xml_prefix = 'pano_xml_';
    /**
     *
     */
    public function get_pano_xml_key($scene_id){
        return $this->pano_xml_prefix.$scene_id;
    }
    public function get_mem_data($key){
        return $this->get_data($key);
    }
    public function set_mem_data($key, $value, $expire){
        return $this->setValue($key, $value, $expire);
    }
    public function rm_mem_datas($key){
        return $this->deleteValue($key);
    }

}