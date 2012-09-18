<?php
ini_set('memory_limit', '100M');
Yii::import('application.extensions.image.Image');
class PictrueController extends FController{
    public $defaultAction = 'index';
    private $folder = '';

    public function actionIndex(){
        $request = Yii::app()->request;
        $id = $request->getParam('id');
        $pic_datas = array('pic_type'=>'jpg', 'pic_content'=>'');
        if($id){
            $img_class = new ImageContent();
            $size = $request->getParam('size') ? $request->getParam('size') : '';
            $pic_datas = $img_class->get_img_content_by_md5file($id, $size);
        }
    }
}