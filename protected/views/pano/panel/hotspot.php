<div class="panel_box_content" >
	<div class="panel_title">
		<div class="title-bar">
			<span>热点</span>
			<div class="title_tip">
				pan：<span id="hotspot_info_pan">0</span>
				tilt：<span id="hotspot_info_tilt">0</span>&nbsp;
				fov：<span id="hotspot_info_fov">90</span>&nbsp;
			</div>
		</div>
		<div class="panel_close" onclick="hide_edit_panel();hide_hotspot_icon()">X</div>
	</div>
	<div class="panle_content" style="height:220px;width:250px;">
	<div class="panel_form">
	<form method="post" class="form-horizontal" id="member_login" action="<?=$this->createUrl('/member/login/checkLogin');?>">
		<div class="control-group">
            <label for="hotspot_info_d_type" class="control-label">热点类型</label>
            <div class="controls" >
              	<select name="type" id="hotspot_info_d_type">
              		<option value="2" selected="selected">swf</option>
	                <!-- <option value="1">image</option>
	                <option value="3">video</option> -->
	            </select>
            </div>
          </div>
          <div class="control-group">
            <label for="hotspot_info_d_link_scene_id" class="control-label">热点类型</label>
            <div class="controls">
              	<select name="link_scene_id" id="hotspot_info_d_link_scene_id" onchange="change_hotspot_select()">
	            	<option value="0">选择场景</option>
	                <?php if($datas['link_scene']){ foreach($datas['link_scene'] as $v){?>
	                <option value="<?=$v['id']?>"><?=$v['name']?></option>
	                <?php }}?>
	            </select>
	            
            </div>
          </div>
          
          <div class="hotspot_save_btn">
          	<button type="button" onclick="save_hotspot_detail(<?=$datas['scene_id']?>)" class="btn btn-primary">新增热点</button>
          	<span id="save_hotspot_tip_flag"></span>
          </div>
	    <img src="" id="hotspot_pano_thumb" width="240" height="120">
		</form>
		</div>
	</div>
</div>
<script>
function change_hotspot_select(){
    var id = $('#hotspot_info_d_link_scene_id').val();
    var url = '<?php echo Yii::app()->createUrl('/panos/thumb/pic/', array('size'=>'240x120.jpg', 'id'=>''));?>/'+id;
    $('#hotspot_pano_thumb').attr('src', url);
}
</script>


