<?php
class ProjectController extends Controller{
    public $defaultAction = 'list';
    public $layout = 'page';
    private $page_size = 5;

    public function actionList(){
        $request = Yii::app()->request;
        $datas = array();
        $member_id = $this->member_id;
        $datas = array();
        if($member_id){
            //获取项目列表
            $project_db = Project::model();
            $criteria=new CDbCriteria;
            $criteria->order = 'id DESC';
            $criteria->addCondition("member_id={$member_id}");
            $criteria->addCondition('status=1');
            $total = $project_db->count($criteria);
            if($total>0){
                $page = $request->getParam('page')?$request->getParam('page'):0;
                $offset = $page*$this->page_size;
                $pages=new CPagination($total);
                $pages->pageSize = $this->page_size;
                $pages->route = '/pano/project/list/';
                $criteria->limit = $this->page_size;
                $criteria->offset = $offset;
                $pages->applyLimit($criteria);
                $datas['pages'] = $pages;
                $datas['list'] = $project_db->findAll($criteria);
            }
        }

        $this->render('/pano/projectList', array('datas'=>$datas));
    }
}