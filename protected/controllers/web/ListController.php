<?php
class ListController extends FController{
    public $defaultAction = 'a';
    public $layout = 'home';
    public $project_db = null;
    public $page_size = 5; //每页显示的数
    public $page_obj = null;

    public function actionA(){
        $datas['projects'] = $this->get_project_list();
        $datas['pages'] = $this->page_obj;
        $this->render('/web/list', array('datas'=>$datas));
    }
    private function get_project_list(){
    	$datas = array();
    	$this->project_db = new Project();
    	
    	$total = $this->project_db->get_project_num();
    	if($total>0){
    		$route = '/web/list/a';
    		$this->page_obj = $this->page($page, $this->page_size, $total, $route);
    		$offset = ($page-1)*$this->page_size;
    		$order = 'id DESC';
    		//获取场景信息
    		$project_datas = $this->project_db->get_project_list($this->page_size, $order, $offset);
    	}
    	
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