<?php
class SaladoController extends Controller{
    public $defaultAction = 'edit';
    public $layout = 'home';
    public $editPano = false;

    public function actionEdit(){
        $request = Yii::app()->request;
        $this->editPano = true;
        $scene_id = $request->getParam('id');
        if(!$scene_id){
            exit('参数错误');
        }
        
        $datas['pano'] = $this->get_scenes($scene_id);
        $datas['page_title'] = '编辑全景图';
        $this->render('/pano/panoEdit', array('datas'=>$datas));
    }
    /**
     * 获取场景信息
     */
    private function get_scenes($scene_id){
        $scene_db = new Scene();
        return  $scene_db->get_by_scene_id($scene_id);
    }
}