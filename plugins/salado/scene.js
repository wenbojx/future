
$(document).ready(function() {
	$('#menu_scroller').bind('click',function(){
		bind_scroller();
    });
	$('#scroll_close').bind('click',function(){
		bind_scroller();
    });
})

jQuery.fn.extend({
  slideRightShow: function() {
    return this.each(function() {
      jQuery(this).animate({width: 'show'});
    });
  },
  slideLeftHide: function() {
    return this.each(function() {
      jQuery(this).animate({width: 'hide'});
    });
  },
  slideRightHide: function() {
    return this.each(function() {
    	jQuery(this).animate({width: 'hide'});
    });
  },
  slideLeftShow: function() {
    return this.each(function() {
    	jQuery(this).animate({width: 'show'});
    });
  }
});

function bind_scroller(){
	if ($("#scroll_pano_detail").is(":hidden")){
		show_scroller();
	}
	else{
		hide_scroller();
	}
}
function show_scroller(){
	$("#scroll_pano_opacity").show();
	$("#scroll_pano_detail").show();
	$("#scroll_close").show();
	load_menuscroller();
}
function hide_scroller(){
	$("#scroll_pano_opacity").hide();
	$("#scroll_pano_detail").hide();
	$("#scroll_close").hide();
}
var menuscroller = false;
function load_menuscroller(){
	if(menuscroller){
		return false;
	}
	$(".scroll_pano .jCarouselLite").jCarouselLite({
		btnPrev: ".scroll_pano .pano_next",
	    btnNext: ".scroll_pano .pano_prev",
	    visible: 4,
	    //auto: 1500,
	    //speed: 1000,
	    vertical: true
	});
	menuscroller = true;
}
function load_scene(box_id, scene_xml, player_url,wmode ){
	if(!wmode){
		wmode = 'Window';
	}
    var flashvars = {};
    flashvars.xml = scene_xml;
    var params = {};
    params.menu = "false";
    params.quality = "high";
    params.wmode = wmode;
    params.allowfullscreen = "true";
    swfobject.embedSWF(player_url, box_id, "100%", "100%", "10.1.0", "", flashvars, params);
}

function salado_handle_click(actionId){
	// exposed by default
	document.getElementById(scene_box).runAction(actionId);
}
