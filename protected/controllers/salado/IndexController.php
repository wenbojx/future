<?php
ini_set('memory_limit', '100M');
class IndexController extends FController{
    public $defaultAction = 'a';
    //public $layout = 'scene';
    public $img_size = 1024;

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
        $request = Yii::app()->request;
        $id = $request->getParam('id');
        if($request->getParam('s_f')){
            $this->actionImage($id, 'front');
        }
        elseif($request->getParam('s_r')){
            $this->actionImage($id, 'right');
        }
        elseif($request->getParam('s_b')){
            $this->actionImage($id, 'back');
        }
        elseif($request->getParam('s_l')){
            $this->actionImage($id, 'left');
        }
        elseif($request->getParam('s_u')){
            $this->actionImage($id, 'up');
        }
        elseif($request->getParam('s_d')){
            $this->actionImage($id, 'down');
        }
        else{
            $this->actionXmlb($id);
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
        $this->render('/salado/xmlb', array('datas'=>$datas));
    }
    private function actionImage($id, $position){
        $flag = true;
        if( $id && $position){
            $scene_file_db = new MpSceneFile();
            $scene_file_datas = $scene_file_db->get_file_by_scene_position($id, $position);
            if(!$file_id = $scene_file_datas->file_id){
                $flag = false;
            }
            $size = $this->img_size.'x'.$this->img_size.'.jpg';
        }
        else{
            $flag = false;
        }
        $img_class = new ImageContent();
        $pic_datas = $img_class->get_img_content_by_id($file_id, $size);
        if(!$pic_datas){
            //获取默认图片
            $default_img = 'pages/salado/default.jpg';
            $pic_datas = $img_class->get_default_img($default_img, 'jpg');
        }
    }

}