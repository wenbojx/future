<?php
class DetailController extends FController{
    public $defaultAction = 'a';
    public $layout = 'home';
    public $default_scroller_num = 6;

    public function actionA(){

        $request = Yii::app()->request;
        $datas['scene_id'] = $request->getParam('id');
        if($datas['scene_id']){
            $datas['scene'] = $this->get_scene_datas($datas['scene_id']);

            if($datas['scene']){
                $datas['project'] = $this->get_project_datas($datas['scene']['project_id']);
            }

            $datas['extend'] = $this->get_extend_datas($datas['scene_id'], $datas['project']['id']);
        	//print_r($datas['extend']);
        }
        $this->render('/web/detail', array('datas'=>$datas));
    }
    /**
     * 获取热点
     */
    private function get_hotspots($scene_id){
    	if(!$scene_id){
    		return array();
    	}
    	$hotspot_db = new ScenesHotspot();
    	return $hotspot_db->find_by_scene_id($scene_id);
    }
    /**
     * 获取相关场景
    */
    private function get_extend_datas($scene_id, $project_id){
    	$extend_datas = array();
    	$extend_datas['hotspot'] = $this->get_hotspots($scene_id);
    	$num = $this->default_scroller_num - count($extend_datas['hotspot']);
        $scene_db = new Scene();
        $extend_datas['extend'] = $scene_db->find_extend_scene_project($scene_id, $num, $project_id);

        return $extend_datas;
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