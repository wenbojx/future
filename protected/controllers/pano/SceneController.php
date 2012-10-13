<?php
class SceneController extends Controller{
    public $defaultAction = 'list';
    public $layout = 'home';
    private $page_size = 5;
    public $madmin = true;

    public function actionList(){
        $request = Yii::app()->request;
        $datas = array();
        $project_id = $request->getParam('id');
        $datas = array();
        if($project_id){
            //获取场景列表
            $scene_db = new Scene();
            $criteria=new CDbCriteria;
            $criteria->order = 'id ASC';
            $criteria->addCondition("project_id={$project_id}");
            $criteria->addCondition('status=1');
            $total = $scene_db->count($criteria);
            if($total>0){
                $page = $request->getParam('page')?$request->getParam('page'):0;
                $offset = $page*$this->page_size;
                $pages=new CPagination($total);
                $pages->pageSize = $this->page_size;
                $pages->route = '/pano/scene/list';
                $criteria->limit = $this->page_size;
                $criteria->offset = $offset;
                $pages->applyLimit($criteria);
                $datas['pages'] = $pages;
                //获取场景信息
                $datas['list'] = $scene_db->findAll($criteria);

            }
        }
        $datas['page_title'] = '场景列表';
        $this->render('/pano/sceneList', array('datas'=>$datas, 'project_id'=>$project_id));
    }
    public function actionPublish(){
    	$request = Yii::app()->request;
    	$scene_id = $request->getParam('scene_id');
    	$this->check_scene_own($scene_id);
    	$msg['flag'] = 1;
    	$msg['msg'] = '操作成功';
    	$display = $request->getParam('display');
    	$scene_db = new Scene();
    	$datas = $scene_db->update_scene_dispaly($scene_id, $display);
    	if(!$datas){
    		$msg['flag'] = 0;
    		$msg['msg'] = '操作失败';
    	}
    	$this->display_msg($msg);
    }
    
    public function actionAdd(){
    	$request = Yii::app()->request;
    	$project_id = $request->getParam('id');
    	$datas['page_title'] = '添加场景';
    	$this->render('pano/sceneEdit', array('datas'=>$datas, 'project_id'=>$project_id));
    }
    public function actionDoAdd(){
    	$request = Yii::app()->request;
    	$msg['flag'] = 1;
    	$msg['msg'] = '操作成功';
    
    	$datas['name'] = $request->getParam('name');
    	$datas['desc'] = $request->getParam('desc');
    	$datas['project_id'] = $request->getParam('project_id');
    	$datas['photo_time'] = $request->getParam('photo_time');
    	$this->check_project_owner($datas['project_id']);
    	
    	if($datas['name'] == '' || !$datas['project_id']){
    		$msg['flag'] = 0;
    		$msg['msg'] = '操作失败';
    		$this->display_msg($msg);
    	}
    
    	if(!$id = $this->add_scene($datas)){
    		$msg['flag'] = 0;
    		$msg['msg'] = '操作失败';
    	}
    	$this->display_msg($msg);
    }
    public function add_scene($datas){
    	$scene_db = new Scene();
    	$datas['member_id'] = $this->member_id;
    	$datas['created'] = $datas['photo_time'] ? strtotime($datas['photo_time']) : '0';
    	return $scene_db->add_scene($datas);
    }
    
}


