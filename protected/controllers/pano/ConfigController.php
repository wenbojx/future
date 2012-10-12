<?php
class ConfigController extends Controller{
    public $defaultAction = 'v';
    public $defaultType = array(
            'face', 'position', 'basic', 'camera', 'view', 'hotspot',
            'button', 'map', 'navigat', 'radar',
            'html', 'rightkey', 'link', 'flare','action','thumb'
            );
    private $pano_thumb_size = '240x120';

    public function actionV(){
        $request = Yii::app()->request;
        $datas = array();
        $scene_id = $request->getParam('scene_id');
        if(!$scene_id){
            exit('参数错误');
        }
        $datas['scene_id'] = $scene_id;
        $type = $request->getParam('t');
        if ($type == 'hotspot'){
            $datas['link_scene'] = $this->get_link_scenes($scene_id);
        }
        elseif ($type == 'thumb'){
            $datas['thumb'] = $this->get_thumb($scene_id);
        }
        elseif ($type == 'face'){
            $scene_files = $this->get_scene_pic($scene_id);
            $datas['scene_files'] = $this->get_file_url($scene_files);
        }
        if(!in_array($type, $this->defaultType)){
            exit();
        }
        $this->render('/pano/panel/'.$type, array('datas'=>$datas));
    }

    /**
     * 获取图片地址
     */
    private function get_file_url($scene_files){
        $file_url = array();
        $pic_name = '120x120.jpg';
        $default_scene = array('left', 'right', 'down', 'up', 'front', 'back');
        foreach ($default_scene as $v){
            $file_url[$v] = isset($scene_files[$v]) && $scene_files[$v] ? $this->createUrl('/home/pictrue/index/', array('id'=>$scene_files[$v], 'size'=>$pic_name)) : $this->get_default_url($v);
        }
        unset($scene_files);
        return $file_url;
    }
    /*
     * 获取全景图
    */
    private function get_scene_pic($scene_id){
        $pics = array();
        if(!$scene_id){
            return $pics;
        }
        $scene_file_db = new MpSceneFile();
        return $scene_file_db->get_scene_list($scene_id);
    }
    /**
     * 获取默认图片地址
     */
    private function get_default_url($position){
        return Yii::app()->baseUrl."/pages/images/box_{$position}.gif";
    }
    /**
     * 获取场景缩略图
     */
    private function get_thumb($scene_id){
        $thumb_db = new ScenesThumb();
        if($thumb_db->find_by_scene_id($scene_id)){
            return $this->createUrl('/panos/thumb/pic/', array('id'=>$scene_id, 'size'=>$this->pano_thumb_size.'.jpg'));
        }
        return false;
    }
    /**
     * 获取项目中的其他场景列表
     */
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
        $criteria->order = 'id ASC';
        $criteria->addCondition("project_id={$project_id}");
        $criteria->addCondition("id!={$scene_id}");
        $criteria->addCondition('status=1');
        $scene_datas = $scene_db->findAll($criteria);
        return $scene_datas;
    }

}