<?php
ini_set('memory_limit', '100M');
class IndexController extends FController{
    public $defaultAction = 'a';
    //public $layout = 'scene';
    public $img_size = 1024;
    public $tile_size = 512;
    public $request = null;

    public function actionA(){
        $request = Yii::app()->request;
        $id = $request->getParam('id');
        $from = $request->getParam('from');
        if(!$id){
            exit('');
        }
        $this->actionXmla($id, $from);
    }
    public function actionB(){
        $this->request = Yii::app()->request;
        $id = $this->request->getParam('id');
        $file = '512x512.jpg';
        if($this->request->getParam('s_f')){
        	$suffix = $this->request->getParam('s_f');
        	if($suffix == '10'){
        		$file = $this->get_tilt_folder();
        	}
            $this->actionImage($id, 'front', $suffix, $file);
        }
        elseif($this->request->getParam('s_r')){
        	$suffix = $this->request->getParam('s_r');
        	if($suffix == '10'){
        		$file = $this->get_tilt_folder();
        	}
            $this->actionImage($id, 'right', $suffix, $file);
        }
        elseif($this->request->getParam('s_b')){
        	$suffix = $this->request->getParam('s_b');
        	if($suffix == '10'){
        		$file = $this->get_tilt_folder();
        	}
        	$rand = rand(0, 10);
        	$water_flag = !$rand%2?true:false;
            $this->actionImage($id, 'back', $suffix, $file, $water_flag);
        }
        elseif($this->request->getParam('s_l')){
        	$suffix = $this->request->getParam('s_l');
        	if($suffix == '10'){
        		$file = $this->get_tilt_folder();
        	}
        	$rand = rand(0, 10);
        	$water_flag = !$rand%2?true:false;
            $this->actionImage($id, 'left', $suffix, $file, $water_flag);
        }
        elseif($this->request->getParam('s_u')){
        	$suffix = $this->request->getParam('s_u');
        	if($suffix == '10'){
        		$file = $this->get_tilt_folder();
        	}
            $this->actionImage($id, 'up', $suffix, $file);
        }
        elseif($this->request->getParam('s_d')){
        	$suffix = $this->request->getParam('s_d');
        	if($suffix == '10'){
        		$file = $this->get_tilt_folder();
        	}
            $this->actionImage($id, 'down', $suffix, $file);
        }
        else{
            $this->actionXmlb($id);
        }
    }
    private function get_tilt_folder(){
    	$file = array('0x0.jpg', '0x1.jpg', '1x0.jpg', '1x1.jpg');
    	if($this->request->getParam('0_0.jpg') !== NULL){
    		return $file[0];
    	}
    	if($this->request->getParam('0_1.jpg') !== NULL){
    		return $file[2];
    	}
    	if($this->request->getParam('1_0.jpg') !== NULL){
    		return $file[1];
    	}
    	if($this->request->getParam('1_1.jpg') !== NULL){
    		return $file[3];
    	}
    }
    private function actionXmla($id, $from){
        //获取全景信息
        $player_obj = new SaladoPlayer();
        $datas['scene_id'] = $id;
        $admin = false;
        if($from == 'admin'){
            $admin = true;
        }
        $datas['content'] = $player_obj->get_config_content($id, $admin);
        $this->render('/salado/xmla', array('datas'=>$datas));
    }
    private function actionXmlb($id){
        $datas['scene_id'] = $id;
        $datas['imgSize'] = $this->img_size;
        $datas['tileSize'] = $this->tile_size;
        $this->render('/salado/xmlb', array('datas'=>$datas));
    }
    private function actionImage($id, $position, $suffix='', $file = '', $water= true){
        $flag = true;
        $pic_datas = array();
        if( $id && $position){
            $scene_file_db = new MpSceneFile();
            $scene_file_datas = $scene_file_db->get_file_by_scene_position($id, $position);
            if (!$scene_file_datas || !$file_id = $scene_file_datas['file_id']){
                $flag = false;
            }
            $size = $file;
        }
        else{
            $flag = false;
        }
        $img_class = new ImageContent();
        if($flag){
        	$img_class->water = $water;
        	$pic_datas = $img_class->get_img_content_by_id($file_id, $size, $suffix, true);
        }
        if(!$pic_datas){
        	//获取默认图片
        	$default_img = 'plugins/salado/default.jpg';
        	$pic_datas = $img_class->get_default_img($default_img, 'jpg');
        }
    }

}