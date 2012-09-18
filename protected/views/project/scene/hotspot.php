<div>
    <div class="input-box">
    	<li>
	    	pan: <span id="hotspot_info_d_pan">0</span>
	        tilt: <span id="hotspot_info_d_tilt">0</span>
	        fov: <span id="hotspot_info_d_fov">90</span>
        </li>
        <li><span>热点类型：</span></li>
        <li>
            <select name="type" id="hotspot_info_d_type">
                <option value="1">image</option>
                <option value="2" selected="selected">swf</option>
                <option value="3">video</option>
            </select>
        </li>
        <li><span>链接场景：</span></li>
        <li>
            <select name="link_scene_id" id="hotspot_info_d_link_scene_id">
                <?php if($datas['link_scene']){ foreach($datas['link_scene'] as $v){?>
                <option value="<?=$v['id']?>"><?=$v['name']?></option>
                <?php }}?>
            </select>
        </li>
        <li class="input-box-save">
            <a style="" class="button" href="javascript:;" onclick="save_hotspot_detail(<?=$datas['scene_id']?>)">保  存</a>
        </li>
        <li><span id="hotspot_save_msg"></span></li>
    </div>
</div>
<script>
$("#hotspot_info_d_pan").html($("#hotspot_info_pan").html());
$("#hotspot_info_d_tilt").html($("#hotspot_info_tilt").html());
$("#hotspot_info_d_fov").html($("#hotspot_info_fov").html());
</script>