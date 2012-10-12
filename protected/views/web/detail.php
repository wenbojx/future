<?php $this->pageTitle=$datas['project']['name'].'---足不出户，畅游中国';?>
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
                <button class="btn btn-success">返回</button>
                <button class="btn">相关</button>
                <button class="btn">地图</button>
                <button class="btn">足迹</button>
                <button class="btn">游记</button>
                <!-- <button class="btn">攻略</button> -->
                <button class="btn">评论</button>
                
            </div>
            <!-- 
            <div class="thumbnail margin-top15">
            <?php if($datas['extend']){ foreach ($datas['extend'] as $v){?>
                <div class="align-center margin-tb10">
                    <a href="<?=$this->createUrl('/web/detail/a/', array('id'=>$v['id']));?>">
                        <img src="<?=$this->createUrl('/panos/thumb/pic/', array('id'=>$v['id'], 'size'=>'200x100.jpg'));?>"/>
                    </a>
                </div>
            <?php }}?>
            </div>
            -->
        </div>
    </div>
</div>
<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/style/js/common.js"?>"></script>
<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/pages/salado/scene.js"?>"></script>
<script>
var player_url = '<?=Yii::app()->baseUrl?>/pages/salado/Player.swf';
var scene_xml_url = '<?=$this->createUrl('/salado/index/a/', array('id'=>$datas['scene_id']))?>';
load_scene('scene_box', scene_xml_url, player_url);
</script>

