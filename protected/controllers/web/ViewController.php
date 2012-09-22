<?php
class ViewController extends FController{
    public $defaultAction = 'a';
    public $layout = 'home';

    public function actionA(){
    	$request = Yii::app()->request;
    	$project_id = $request->getParam('id');
    	$datas = array();
    	if($project_id){
    		$datas['project'] = $this->get_project_datas($project_id);
    		$datas['list'] = $this->get_scene_datas($project_id);
    	}
        $this->render('/web/view', array('datas'=>$datas));
    }
    private function get_project_datas($project_id){
    	$project_db = new Project();
    	return $project_db->find_by_project_id($project_id);
    }
    private function get_scene_datas($project_id){
    	$scene_db = new Scene();
    	$order = 'id ASC';
    	return $scene_db->find_scene_by_project_id($project_id, 0, $order);
    }
}