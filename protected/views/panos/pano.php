<div style="width:800px;height:500px;margin:0 auto">
	<div id="scene_box" ></div>
</div>
<script>
var scene_xml_url = '<?=$this->createUrl('/salado/index/a/', array('id'=>$datas['scene_id']))?>';
load_scene('scene_box', scene_xml_url)
</script>