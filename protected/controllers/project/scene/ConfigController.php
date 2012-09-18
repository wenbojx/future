<?php
class ConfigController extends Controller{
    public $defaultAction = 'v';
    public $defaultType = array(
            'position', 'basic', 'preview', 'view', 'hotspot',
            'button', 'map', 'navigat', 'radar',
            'html', 'rightkey', 'link', 'flare','action','thumb'
            );

    public function actionV(){
        $request = Yii::app()->request;
        $datas = array();
        $scene_id = $request->getParam('scene_id');
        $datas['scene_id'] = $scene_id;
        $type = $request->getParam('t');
        if ($type == 'hotspot'){
            $datas['link_scene'] = $this->get_link_scenes($scene_id);
        }
        if(!in_array($type, $this->defaultType)){
            exit();
        }
        $this->render('/project/scene/'.$type, array('datas'=>$datas));
    }

    private function get_link_scenes($scene_id){
        $scene_datas = array();
        if(!$scene_id){
            return $scene_datas;
        }
        //获取project_id
        $scene_db = new Scene();
        $scene_data = $scene_db->get_by_scene_id($scene_id);
        if(!$scene_data || !$scene_data->project_id){
            return $scene_datas;
        }
        $project_id = $scene_data->project_id;
        $criteria=new CDbCriteria;
        $criteria->order = 'id DESC';
        $criteria->addCondition("project_id={$project_id}");
        $criteria->addCondition("id!={$scene_id}");
        $criteria->addCondition('status=1');
        $scene_datas = $scene_db->findAll($criteria);
        return $scene_datas;
    }

}