<?php
class SceneController extends Controller{
    public $defaultAction = 'list';
    public $layout = 'page';
    private $page_size = 5;

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
                $pages->route = '/project/sceneList/list';
                $criteria->limit = $this->page_size;
                $criteria->offset = $offset;
                $pages->applyLimit($criteria);
                $datas['pages'] = $pages;

                //获取场景信息
                $datas['list'] = $scene_db->findAll($criteria);

            }
        }
        $this->render('/project/sceneList', array('datas'=>$datas, 'project_id'=>$project_id));
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
}


