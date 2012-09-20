<style>
.uploadify-queue{
    float:left;
}
.uploadify{
	float:left;
}
</style>
<div class="box_open">
    <div class="input-box">
        <li>
            <a style="" id="thumb_box_upload" class="button" href="javascript:;">上传缩略图</a>
            
        </li>
        <li style="clear:both">
        	<div id="thumb_img"></div>
        </li>
    </div>
</div>

<script type="text/javascript">
var thumb_upload_url='<?=$this->createUrl('/ajax/uploadFile/')?>';
var scene_id = '<?=$datas['scene_id']?>';
var thumb_button_img = "<?=Yii::app()->baseUrl?>/pages/images/upload_thumb.gif";
thumb_box_upload();
</script>