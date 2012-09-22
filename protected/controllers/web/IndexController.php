<?php
class IndexController extends Controller{
    public $defaultAction = 'a';
    public $layout = 'home';

    public function actionA(){
        $datas = $this->get_last_pano(8);
        $this->render('/web/index', array('datas'=>$datas));
    }

    /**
     * 获取最新的8个全景
     */
    private function get_last_pano($num=8){
    	$scene_db = new Scene();
    	$criteria=new CDbCriteria;
    	$criteria->order = 'id DESC';
    	$criteria->addCondition('status=1');
    	$criteria->addCondition('display=2');
    	$criteria->limit = $num;
    	return $scene_db->findAll($criteria);
    }
}