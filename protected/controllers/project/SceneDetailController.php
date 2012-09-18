<?php
class SceneDetailController extends Controller{
    public $defaultAction = 'detail';
    public $layout = 'scene';

    public function actionDetail(){
        $request = Yii::app()->request;
        $datas = array();
        $scene_id = $request->getParam('id');
        $datas['scene_id'] = $scene_id;
        $this->render('/project/sceneDetail', array('datas'=>$datas));
    }
    /**
     * 获取场景列表
     */
    private function get_scenes_by_mp($project_list){
        $datas = array();
        $scene_ids = array();
        if(!is_array($project_list) || count($project_list)<=0){
            return $datas;
        }
        foreach ($project_list as $v){
            $scene_ids[] = $v['scene_id'];
        }
        $scene_db = Scene::model();
        $datas = $scene_db->findAllByPk($scene_ids, array('order'=>'id desc'));
        //print_r($datas);
        return $datas;
    }
}