<?php
class SaladoController extends Controller{
    public $defaultAction = 'edit';
    public $layout = 'home';
    public $editPano = false;

    public function actionEdit(){
        $request = Yii::app()->request;
        $this->editPano = true;
        $scene_id = $request->getParam('id');
        $clean = $request->getParam('clean');
        if(!$scene_id){
            exit('参数错误');
        }
        if($clean){
            $this->clean_cache($scene_id);
            exit();
        }
        $datas['pano'] = $this->get_scenes($scene_id);
        $datas['position'] = $this->get_position($scene_id);
        //print_r($datas);
        $datas['page_title'] = '编辑全景图';
        $this->render('/pano/panoEdit', array('datas'=>$datas));
    }
    /**
     * 清理缓存并跳转
     */
    private function clean_cache($scene_id){
        $memcache_obj = new Ymemcache();
        $key = $memcache_obj->get_pano_xml_key($scene_id, true);
        $memcache_obj->rm_mem_datas($key);
        $this->redirect(array('pano/salado/edit/','id'=>$scene_id));
    }
    /**
     * 获取场景地理位置
     */
    private function get_position($scene_id){
    	$position = array('glng'=>0, 'glat'=>0, 'gzoom'=>12);
    	$position_db = new ScenesPosition();
    	$datas = $position_db->findByPk($scene_id);
    	if(!$datas){
    		$position;
    	}
    	return $datas;
    }
    /**
     * 获取场景信息
     */
    private function get_scenes($scene_id){
        $scene_db = new Scene();
        return  $scene_db->get_by_scene_id($scene_id);
    }
}