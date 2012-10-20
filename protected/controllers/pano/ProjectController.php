<?php
class ProjectController extends Controller{
    public $defaultAction = 'list';
    public $layout = 'home';
    private $page_size = 10;
    public $madmin = true;

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
        $datas['page_title'] = '项目列表';
        $this->render('/pano/projectList', array('datas'=>$datas));
    }
	public function actionAdd(){
		$request = Yii::app()->request;
		$datas = array();
		$datas['page_title'] = '新增项目';
		$this->render('pano/projectEdit', array('datas'=>$datas));
	}
	public function actionDoAdd(){
		$request = Yii::app()->request;
		$datas['name'] = $request->getParam('name');
		$datas['desc'] = $request->getParam('desc');
		$msg['flag'] = 1;
		$msg['msg'] = '操作成功';
		if($datas['name'] == ''){
			$msg['flag'] = 0;
			$msg['msg'] = '操作失败';
			$this->display_msg($msg);
		}
		if(!$id = $this->add_project($datas)){
			$msg['flag'] = 0;
			$msg['msg'] = '操作失败';
		}
		$this->display_msg($msg);
	}
	public function add_project($datas){
		$project_db = new Project();
		$datas['member_id'] = $this->member_id;
		$datas['created'] = time();
		return $project_db->add_project($datas);
	}
}