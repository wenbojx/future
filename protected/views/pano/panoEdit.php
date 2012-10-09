<?php $this->pageTitle=$datas['page_title'].'---足不出户，畅游中国';?>
<div class="detail">
    <div class="hero-unit margin-top55">
        <h2>足不出户  畅游中国</h2>
    </div>
    <div class="row-fluid">
        <div class="span11">
            <div class="thumbnail">
                <div class="pano-detail">
                    <div id="scene_box"></div>
                </div>
            </div>
        </div>
        <div class="span1">
            <div class="thumbnail">
                <button class="btn btn-success">预览</button>
                <button class="btn">上传</button>
                <button class="btn">位置</button>
                <button class="btn">缩略</button>
                <button class="btn">摄像</button>
                <button class="btn">视角</button>
                <button class="btn">热点</button>
                <!-- <button class="btn">按钮</button>
                <button class="btn">导航</button> -->
                <button class="btn btn-warning">发布</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/style/js/common.js"?>"></script>
<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/pages/salado/scene.js"?>"></script>
<script>
var player_url = '<?=Yii::app()->baseUrl?>/pages/salado/Player.swf';
var scene_xml_url = '<?=$this->createUrl('/salado/index/a/', array('id'=>$datas['pano']['id']))?>';
load_scene('scene_box', scene_xml_url, player_url);

var position_url = '<?=$this->createUrl('/project/scene/config/v/', array('t'=>'position', 'scene_id'=>$datas['pano']['id']))?>';
var preview_url = '<?=$this->createUrl('/project/scene/config/v/', array('t'=>'preview', 'scene_id'=>$datas['pano']['id']))?>';
var thumb_url = '<?=$this->createUrl('/project/scene/config/v/', array('t'=>'thumb', 'scene_id'=>$datas['pano']['id']))?>';
var hotspot_url = '<?=$this->createUrl('/project/scene/config/v/', array('t'=>'hotspot', 'scene_id'=>$datas['pano']['id']))?>';
bind_scene_btn();
</script>

