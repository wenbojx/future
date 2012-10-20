<style>
.uploadify-queue{
    position:absolute;
    top:0;
    right:0;
    bottom:0;
    left:0;
}
</style>
<div class="panel_box_content" >
<div class="panel_title">
	<div class="title-bar">上传全景图1</div>
	<div class="panel_close" onclick="hide_edit_panel()">X</div>
</div>
<div class="panle_content" style="height:360px;">
	<div class="box_open">
	    <div class="box_side box_left" id="box_side_left"><img id="box_left" src="<?=$datas['scene_files']['left']?>"/></div>
	    <div class="box_side box_right" id="box_side_right"><img id="box_right" src="<?=$datas['scene_files']['right']?>"/></div>
	    <div class="box_side box_down" id="box_side_down"><img id="box_down" src="<?=$datas['scene_files']['down']?>"/></div>
	    <div class="box_side box_up" id="box_side_up"><img id="box_up" src="<?=$datas['scene_files']['up']?>"/></div>
	    <div class="box_side box_front" id="box_side_front"><img id="box_front" src="<?=$datas['scene_files']['front']?>"/></div>
	    <div class="box_side box_back" id="box_side_back"><img id="box_back" src="<?=$datas['scene_files']['back']?>"/></div>
	</div>
</div>
</div>

<script type="text/javascript">
var script_url='<?=$this->createUrl('/pano/upload/')?>';
var scene_id = '<?=$datas['scene_id']?>';
var width = 120;
var height = 120;
init_box_upload('left');
init_box_upload('right');
init_box_upload('down');
init_box_upload('up');
init_box_upload('front');
init_box_upload('back');
</script>