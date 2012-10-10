$(document).ready(function() {
    bind_pano_btn();
})
function bind_pano_btn(){
    $('#btn_upload').bind('click',function(){
        load_page(upload_pano_url);
    });
    $('#btn_position').bind('click',function(){
        load_page(position_url);
    });
    $('#btn_thumb').bind('click',function(){
        load_page(thumb_url);
    });
    $('#btn_hotspot').bind('click',function(){
        load_page(hotspot_url);
    });
}
function load_page(url){
    var ajax = {url: url, type: 'GET', dataType: 'html', cache: false, success: function(html) {
                $("#panel_box").html(html);
                return true;
            }
        };
    $.ajax(ajax);
}


function thumb_box_upload(){
    var post_datas = {'scene_id':scene_id,'from':'thumb_pic','SESSION_ID':session_id};
    $("#thumb_box_upload").uploadify({
        'swf': flash_url,
        'uploader': thumb_upload_url,
        'formData': post_datas,
        //'uploadLimit':1,
        'buttonText':'上传全景图',
        'debug':false,
        'width':107,
        'height':34,
        'fileSizeLimit':'5242880KB',
        'fileTypeDesc' : 'jpg,png,gif格式',
        'fileTypeExts':'*.jpg;*.png;*.gif;',
        'buttonImage':thumb_button_img,
        'multi': false,
        'removeTimeout':1,
        'auto': true,
        'onSelectError':function(file){
        },
        'onUploadError':function(file){
        },
        'onUploadSuccess':function(file, data, response){
            var dataObj = eval("("+data+")");
            if(dataObj.status == '0'){
                alert(dataObj.msg);
            }
            else if(response>0){
                var url = pic_url+'/id/'+dataObj.file+'/size/480x240.jpg';
                var img_str = '<img width="480" height="240" src="'+url+'"/>';
                $("#thumb_img").html(img_str);
            }
        }
    });
}
function init_box_upload( position){
    //var img_w = 800;
    //var img_h = 800;
    var img_btn_w = 150;
    var img_btn_h = 150;
    var button_img = $("#box_"+position).attr('src');
    var post_datas = {'position':position,'scene_id':scene_id,'from':'box_pic','SESSION_ID':session_id};
    $("#box_"+position).uploadify({
        'swf': flash_url,
        'uploader': script_url,
        'formData': post_datas,
        //'uploadLimit':1,
        'buttonText':'上传',
        'debug':false,
        'width':img_btn_w,
        'height':img_btn_h,
        'fileSizeLimit':'5242880KB',
        'fileTypeDesc' : 'jpg,png,gif格式',
        'fileTypeExts':'*.jpg;*.png;*.gif;',
        'buttonImage':button_img,
        'multi': false,
        'removeTimeout':1,
        'auto': true,
        'onSelect':function(file){
            change_z_index(500,400);
        },
        'onSelectError':function(file){
            change_z_index(400,500);
        },
        'onUploadError':function(file){
            change_z_index(400,500);
        },
        'onUploadSuccess':function(file, data, response){
            var dataObj = eval("("+data+")");
            if(dataObj.status == '0'){
                alert(dataObj.msg);
            }
            else if(response>0){
                var url = pic_url+'/id/'+dataObj.file+"/size/"+img_btn_w+"x"+img_btn_h+'.jpg';
                //button_img = url;
                $("#"+file.id).hide();
                var img_str = '<img width="'+img_btn_w+'" height="'+img_btn_h+'" id="box_'+position+'" src="'+url+'"/>';
                $("#box_side_"+position).html(img_str);
                init_box_upload(position);
                $("#box_"+position+"-queue").hide();
            }
            change_z_index(400,500);
        }
    });
    function change_z_index(cap1, cap2){
        $("#box_"+position+"-queue").css('z-index', cap1);
        $("#box_"+position).css('z-index', cap2);
    }
}