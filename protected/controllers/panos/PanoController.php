<?php
class PanoController extends FController{
	public $defaultAction = 'show';
	public $layout = 'pano';
	
	public function actionShow(){
		$request = Yii::app()->request;
		$datas['scene_id'] = $request->getParam(id);
		$this->render('/panos/pano', array('datas'=>$datas));
	}
}