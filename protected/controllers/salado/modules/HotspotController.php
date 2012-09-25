<?php
class HotspotController extends Controller{
    public function actionSave(){
        $request = Yii::app()->request;
        $scene_id = $request->getParam('scene_id');
        $datas['scene_id'] = $scene_id;
        $this->check_scene_own($scene_id);
        $datas['pan'] = (int)$request->getParam('pan');
        $datas['tilt'] = (int)$request->getParam('tilt');
        $datas['fov'] = (int)$request->getParam('fov');
        $datas['type'] = $request->getParam('type');
        $datas['link_scene_id'] = $request->getParam('link_scene_id');
        $msg['flag'] = 0;
        $msg['msg'] = '操作失败';
        if($datas['link_scene_id'] == '0' || $datas['link_scene_id'] == ''){
            $this->display_msg($msg);
        }
        $id = $this->add_hotspot($datas);
        if(!$id){
            $this->display_msg($msg);
        }
        $msg['flag'] = 1;
        $msg['msg'] = '操作成功';
        $this->display_msg($msg);
    }
    private function add_hotspot($datas){
        $hotspot_db = new ScenesHotspot();
        return $hotspot_db->add_hotsopt($datas);
    }
}