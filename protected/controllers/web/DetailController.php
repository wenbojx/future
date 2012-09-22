<?php
class DetailController extends FController{
    public $defaultAction = 'a';
    public $layout = 'home';

    public function actionA(){
    	
        $request = Yii::app()->request;
    	$datas['scene_id'] = $request->getParam('id');
    	if($datas['scene_id']){
    		$datas['scene'] = $this->get_scene_datas($datas['scene_id']);
    		print_r(111);
    		exit();
    		if($datas['scene']){
    			$datas['project'] = $this->get_project_datas($datas['scene']['project_id']);
    		}
    		$datas['extend'] = $this->get_extend_datas($datas['scene_id'], $datas['project']['id']);
    	}
        $this->render('/web/detail', array('datas'=>$datas));
    }
    /**
     * 获取相关场景
	*/
    private function get_extend_datas($scene_id, $project_id){
    	$scene_db = new Scene();
    	return $scene_db->find_extend_scene_project($scene_id, 3, $project_id);
    }
    private function get_scene_datas($scene_id){
    	$scene_db = new Scene();
    	return $scene_db->get_by_scene_id($scene_id);
    }
    private function get_project_datas($project_id){
    	$project_db = new Project();
    	return $project_db->find_by_project_id($project_id);
    }
}