<?php
class GlobalController extends Controller{
    public function actionCamera(){
        $request = Yii::app()->request;
        $scene_id = $request->getParam('scene_id');
        $this->check_scene_own($scene_id);
        $camera['pan'] = $request->getParam('pan');
        $camera['tilt'] = $request->getParam('tilt');
        $camera['fov'] = $request->getParam('fov');

        $msg['flag'] = 1;
        $msg['msg'] = '操作成功';
        $id = $this->save_camera($camera, $scene_id);
        if(!$id){
            $msg['flag'] = 0;
            $msg['msg'] = '操作失败';
            $this->display_msg($msg);
        }
        $this->display_msg($msg);
    }
    private function save_camera($camera, $scene_id){
    	$global_db = new ScenesGlobal();
    	$datas['s_attribute']['debug'] = 'false';
    	$global_db->save_global($datas, $scene_id);
    	unset($datas);
    	$panorams_db = new ScenesPanoram();
    	$pan = $camera['pan'] ? $camera['pan'] : '0';
    	$tilt = $camera['tilt'] ? $camera['tilt'] : '0';
    	$fov = $camera['fov'] ? $camera['fov'] : '90';
    	$datas['s_attribute']['camera'] = "pan:{$pan},tilt:{$tilt},fov:{$fov}";
    	return $panorams_db->save_camera($datas, $scene_id);
    }
}