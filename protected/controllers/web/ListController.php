<?php
class ListController extends FController{
    public $defaultAction = 'a';
    public $layout = 'home';

    public function actionA(){
        $datas['projects'] = $this->get_project_list();
        $this->render('/web/list', array('datas'=>$datas));
    }
    private function get_project_list(){
    	$datas = array();
    	$project_db = new Project();
    	$project_datas = $project_db->get_last_project(20);
    	if(!$project_datas){
    		return $datas;
    	}
    	$project_ids = array();
    	foreach($project_datas as $k=>$v){
    		if($scene_datas = $this->get_scene_list($v['id'])){
    			$datas[$v['id']]['project'] = $v;
    			$datas[$v['id']]['scene'] = $scene_datas;
    			$datas[$v['id']]['total_num'] = $this->get_scene_num($v['id']);
    		}
    	}
    	return $datas;
    }
    private function get_scene_list($project_id){
    	$scene_db = new Scene();
    	return $scene_db->find_scene_by_project_id($project_id, 4);
    }
    private function get_scene_num($project_id){
    	if(!$project_id){
    		return 0;
    	}
    	$scene_db = new Scene();
    	return $scene_db->get_scene_num($project_id);
    }
}