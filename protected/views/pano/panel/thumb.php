<style>
.uploadify-queue{
    float:left;
}
.uploadify{
	float:left;
}
</style>
<div class="panel_box_content" >
	<div class="panel_title">
		<div class="title-bar">
			<span>上传缩略图</span>
			<div class="title_tip">
				<span class="label label-warning" id="thumb_box_upload"></span>
				&nbsp;&nbsp;240x120
			</div>
		</div>
		<div class="panel_close" onclick="hide_edit_panel()">X</div>
	</div>
	<div class="panle_content" style="height:120px;width:240px;">
		<div id="thumb_img">
        	<?php if (isset($datas['thumb'])){?>
        		<img alt="" src="<?=$datas['thumb']?>">
        	<?php }?>
        </div>
	</div>
</div>

<script type="text/javascript">
var thumb_upload_url='<?=$this->createUrl('/project/uploadPano/')?>';
var scene_id = '<?=$datas['scene_id']?>';
var thumb_button_img = "<?=Yii::app()->baseUrl?>/style/img/upload_thumb.gif";
thumb_box_upload();
</script>