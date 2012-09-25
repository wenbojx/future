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
    	$criteria=new CDbCriteria;
    	$criteria->order = 'id DESC';
    	$project_datas = $project_db->findAll($criteria);
    	if(!$project_datas){
    		return $datas;
    	}
    	foreach($project_datas as $k=>$v){
    		if($scene_datas = $this->get_scene_list($v['id'])){
    			$datas[$v['id']]['project'] = $v;
    			$datas[$v['id']]['scene'] = $scene_datas;
    		}
    	}
    	return $datas;
    }
    private function get_scene_list($project_id){
    	$scene_db = new Scene();
    	return $scene_db->find_scene_by_project_id($project_id, 4);
    }
}