<style type="text/css">
  @import url("http://www.google.com/uds/css/gsearch.css");
  @import url("http://www.google.com/uds/solutions/localsearch/gmlocalsearch.css");
</style>
<div class="panel_box_content" >
	<div class="panel_title">
		<div class="title-bar">
			<span>地理位置</span>
			<div class="title_tip">
				经度：<span id="span_lng"></span>&nbsp;
				纬度：<span id="span_lat"></span>&nbsp;
				视图高度：<span id="span_zoom"></span>&nbsp;&nbsp;&nbsp;&nbsp;
				<span id="position_save_msg"></span>
				<span class="label label-warning" onclick="save_position_detail(<?=$datas['scene_id']?>)">保存信息</span>
				
			</div>
		</div>
		<div class="panel_close" onclick="hide_edit_panel()">X</div>
	</div>
	<div class="panle_content" style="height:400px;">
		<div id="map_canvas" style="width:815px; height:400px;"></div>
	</div>
</div>

<script>
load_map();
</script>