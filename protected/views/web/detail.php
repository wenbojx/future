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
                	<div id="scroll_pano_opacity" class="scroll_pano_container scroll_pano_opacity"></div>
                	<div class="scroll_close" id="scroll_close">
                		<i class="icon-backward"></i>
                	</div>
                	<div class="scroll_open" id="scroll_open">
                		<i class="icon-chevron-right"></i>
                	</div>
                	<div id="scroll_pano_detail" class="scroll_pano_detail">
                	<div class="scroll_pano_container scroll_pano">
                		<div class="pano_prev">
                			<i class="icon-chevron-up vertical"></i>
                		</div>
                		<div class="jCarouselLite">
					        <ul>
					        <?php 
					        	if(is_array($datas['extend']['hotspot'])){
									foreach($datas['extend']['hotspot'] as $v1){
							?>
								<li>
								<a href="javascript:;" onclick="salado_handle_click('load_pano_<?=$v1['link_scene_id']?>')">
								<img src="/panos/thumb/pic/id/<?=$v1['link_scene_id']?>/size/200x100.jpg">
								</a>
								</li>
							<?php }}
								if(is_array($datas['extend']['extend'])){
									foreach($datas['extend']['extend'] as $v2){
							?>
					            <li>
									<a href="/web/detail/a/id/<?=$v2['id']?>">
										<img src="/panos/thumb/pic/id/<?=$v2['id']?>/size/200x100.jpg">
									</a>
					        	</li>
					        <?php }}?>
					        </ul>
					    </div>
					    <div class="pano_next">
					    <i class="icon-chevron-down vertical"></i>
					    </div>
                	</div>
                	</div>
                </div>
            </div>
        </div>
        <div class="span1">
            <div class="thumbnail">
                <button class="btn btn-success" onclick="jump_to('<?=$this->createUrl('/web/view/a/', array('id'=>$datas['scene']['project_id']))?>')">返回</button>
                <button class="btn" id="menu_scroller">相关</button>
                <button class="btn">地图</button>
                <button class="btn">足迹</button>
                <button class="btn">游记</button>
                <!-- <button class="btn">攻略</button> -->
                <button class="btn">评论</button>
                
            </div>
            
        </div>
    </div>
</div>
<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/style/js/common.js"?>"></script>
<script type="text/javascript" src="<?=Yii::app()->baseUrl . "/plugins/salado/scene.js"?>"></script>
<script>
var scene_box = 'scene_box';
var player_url = '<?=Yii::app()->baseUrl?>/pages/salado/Player.swf';
var scene_xml_url = '<?=$this->createUrl('/salado/index/a/', array('id'=>$datas['scene_id']))?>';
load_scene(scene_box, scene_xml_url, player_url, 'transparent');
</script>

