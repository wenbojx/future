<?php
Yii::import('application.extensions.image.Image');
class SaladoPlayer{
    private $modules_path = '';
    private $modules_media_path = '';
    private $admin = false;

    public function __construct(){
        $this->modules_path = Yii::app()->baseUrl.'/pages/salado/modules/';
        $this->modules_media_path = Yii::app()->baseUrl.'/pages/salado/media/';
    }
    public function set_modules_path($path = ''){
        if($path == ''){
            return false;
        }
        return $this->modules_path = $path;
    }
    public function get_modules_path(){
        return $this->modules_path;
    }
    public function set_modules_media_path($path = ''){
        if($path == ''){
            return false;
        }
        return $this->modules_media_path = $path;
    }
    public function get_modules_media_path(){
        return $this->modules_media_path;
    }
    public function build_attribute($attribute){
        if(!is_array($attribute)){
            return '>';
        }
        $str = ' ';
        if(is_array($attribute)){
            foreach ($attribute as $k=>$v){
                $str .= "{$k}='{$v}' ";
            }
        }
        $str = substr($str, 0, (strlen($str)-1));
        return $str.'>';
    }

    private function config_start(){
        $player_info = '<SaladoPlayer>';
        return $player_info;
    }
    private function config_end(){
        $player_info = '</SaladoPlayer>';
        return $player_info;
    }

    public function get_config_content($id, $admin){
        $panodatas_obj = new PanoramDatas();
        $panodatas = $panodatas_obj->get_panoram_datas($id, $admin);
        $this->admin = $admin;
        $content = $this->config_start();
        $content .= $this->config_global($panodatas['global']);
        $content .= $this->config_panoramas($panodatas['panorams']);
        $content .= $this->config_modules($panodatas['modules']);
        $content .= $this->config_actions($panodatas['actions']);
        $content .= $this->config_end();
        return $content;
    }
    private function config_global($global){
        $global_str = '';
        if(!is_array($global) || count($global)<1){
            return $global_str;
        }
        //全局信息
        $global_obj = new SaladoGlobal();
        $global_str = $global_obj->get_global_info($global);
        return $global_str;
    }
    public function config_panoramas($panorams){
        $panoram_str = '';
        if(!is_array($panorams) || count($panorams)<1){
            return $panoram_str;
        }
        $panoram_obj = new SaladoPanoramas();
        $panoram_str = $panoram_obj->get_panorams_info($panorams);
        return $panoram_str;
    }
    public function config_modules($modules){
        $modules_str = '';
        if(!is_array($modules) || count($modules)<1){
            return $modules_str;
        }
        $modules_obj = new SaladoModules();
        $modules_obj->admin = $this->admin;
        $modules_str = $modules_obj->get_modules_info($modules);
        return $modules_str;
    }
    public function config_actions($actions){
        $actions_str = '';
        if(!is_array($actions) || count($actions)<1){
            return $actions_str;
        }
        $actions_obj = new SaladoActions();
        $actions_str = $actions_obj->get_actions_info($actions);
        return $actions_str;
    }
}