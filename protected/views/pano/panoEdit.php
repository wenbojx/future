<?php $this->pageTitle=$datas['page_title'].'---足不出户，畅游中国';?>
<div class="detail">
    <div class="hero-unit margin-top55">
        <h2>足不出户  畅游中国</h2>
    </div>
    <ul class="breadcrumb">
        <li><?php echo CHtml::link('项目',array('pano/project/list'));?> <span class="divider">/</span></li>
        <li><?php echo CHtml::link('场景',array('pano/scene/list', 'id'=>$datas['pano']['project_id']));?><span class="divider">/</span></li>
        <li class="active"><?=$datas['pano']['name']?></li>
    </ul>
    <div class="row-fluid">
        <div class="span11">
            <div class="thumbnail">
                    <div class="pano-detail" id="pano-detail">
                        <div id="scene_box"></div>
                        <div id="pano_loading" class="pano_loading">
	                    	<img id="pano_loading_img" src="<?=Yii::app()->baseUrl . '/style/img/loading_4.gif'?>"/>
	                    </div>
                        <div id="hotspot_icon" class="hotspot_icon">
                        	<img id="hotspot_icon_img" src="<?=Yii::app()->baseUrl . '/style/img/hotspot/hotspot-10.png'?>"/>
                        </div>
                    </div>
            </div>
        </div>
        <div class="span1">
            <div class="thumbnail">
                <div class="edit_box">
                    <div class="edit_relative">
                        <div class="edit_buttons">
                            <button class="btn btn-success" id="btn_review">载入</button>
                            <button class="btn" id="btn_upload">上传</button>
                            <button class="btn" id="btn_position">位置</button>
                            <button class="btn" id="btn_thumb">缩略</button>
                            <button class="btn" id="btn_camera">摄像</button>
                            <!-- <button class="btn">视角</button> -->
                            <button class="btn" id="btn_hotspot">热点</button>
                            <!-- <button class="btn">按钮</button>
                            <button class="btn">导航</button> -->
                            <button id="online_pano" class="btn btn-warning" style="<?=$datas['pano']['display'] == '1'?'':'display:none' ?>" onclick="publish_scene(<?=$datas['pano']['id']?>,2)">发布</button>
                            <button id="offline_pano" class="btn btn-warning" style="<?=$datas['pano']['display'] == '2'?'':'display:none' ?>" onclick="publish_scene(<?=$datas['pano']['id']?>,1)">下线</button>
                        	<button class="btn btn-primary" id="btn_preview">预览</button>
                        </div>
                        <div class="edit_panel" id="edit_panel">
                            <div id="panel_box" class="panel_box">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
<script>
var scene_id = '<?=$datas['pano']['id']?>';
var baseUrl = '<?=Yii::app()->baseUrl?>';
var clean_url = '<?=$this->createUrl('/pano/salado/edit/', array('id'=>$datas['pano']['id'], 'clean'=>1))?>';
var flash_url = baseUrl+'/pages/uploadify/uploadify.swf';
var session_id = '<?=session_id()?>';
var pic_url = '<?=$this->createUrl('/panos/imgOut/index/')?>';
var google_map_tip_url = baseUrl+'/style/img/dot-s-nomarl_16x24.png';
var save_module_datas_url = '<?=$this->createUrl('/salado/modules/')?>';
var preview_url = '<?=$this->createUrl('/web/detail/a/', array('id'=>$datas['pano']['id']))?>';

var scene_publish_url = '<?=$this->createUrl('/pano/scene/publish')?>';
</script>

<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/style/js/common.js"?>"></script>
<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/plugins/salado/scene.js"?>"></script>

<script>
var player_url = '<?=Yii::app()->baseUrl?>/plugins/salado/Player.swf';
var scene_xml_url = '<?=$this->createUrl('/salado/index/a/', array('id'=>$datas['pano']['id'],'from'=>'admin'))?>';
load_scene('scene_box', scene_xml_url, player_url, 'transparent');

var upload_pano_url = '<?=$this->createUrl('/pano/config/v/', array('t'=>'face', 'scene_id'=>$datas['pano']['id']))?>';
var position_url = '<?=$this->createUrl('/pano/config/v/', array('t'=>'position', 'scene_id'=>$datas['pano']['id']))?>';
//var preview_url = '<?=$this->createUrl('/pano/config/v/', array('t'=>'preview', 'scene_id'=>$datas['pano']['id']))?>';
var thumb_url = '<?=$this->createUrl('/pano/config/v/', array('t'=>'thumb', 'scene_id'=>$datas['pano']['id']))?>';
var camera_url = '<?=$this->createUrl('/pano/config/v/', array('t'=>'camera', 'scene_id'=>$datas['pano']['id']))?>';
var hotspot_url = '<?=$this->createUrl('/pano/config/v/', array('t'=>'hotspot', 'scene_id'=>$datas['pano']['id']))?>';
var hotspot_edit_url = '<?=$this->createUrl('/pano/config/v/', array('t'=>'hotspotEdit', 'scene_id'=>$datas['pano']['id']))?>';
</script>
<!-- 
<script>
var glng = '<?=$datas['position']['glng']?>';
var glat = '<?=$datas['position']['glat']?>';
var gzoom = '<?=$datas['position']['gzoom']?>';
</script>
<script type="text/javascript" src="http://ditu.google.cn/maps?file=api&v=2.95&sensor=false&key=<?=Yii::app()->params['google_map_key']?>"></script>
<script type="text/javascript" src="http://www.google.com/uds/api?file=uds.js&v=1.0&key=<?=Yii::app()->params['google_map_key']?>"></script>
<script type="text/javascript" src="http://www.google.com/uds/solutions/localsearch/gmlocalsearch.js"></script>

<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/style/js/google.map.js"?>"></script>
 -->
