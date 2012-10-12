$(document).ready(function(){
    check_login();
})
function login_state(datas){
    if(datas.flag == '0'){
        $("#m_register").show();
        $("#m_login").show();
    }
    else{
        var str = "" + datas.nick_name + " 您好!";
        $("#m_nickname").html(str);
        $("#m_welcome").show();
        $("#m_loginout").show();
    }
}
function check_login(){
    $.post(check_login_url, {}, login_state, 'json');
}
var jump_url = '';
function jump_to(){
    if(!jump_url){
        return false;
    }
    window.location.href = jump_url;
}


function save_datas(url, data, type, dataType, done){
    if (!url){
        done_error(element_id, msg.error);
    }
    type = type ? type : 'post';
    dataType = dataType ? dataType : 'json';
    $.ajax({
        url: url,
        type: type,
        data: data,
        dataType: dataType,
        //timeout: 1000,
        error: function(){
        	done(datas);
        },
        success: function(datas){
            done(datas);
        }
    });
}
function done_error(element_id, msg){
    $("#"+element_id).html(msg);
    //setTimeout( clean_msg_box(element_id), 50000);
}
function done_success(element_id, msg, datas){
    if(datas.flag == '0'){
        msg = datas.msg;
        done_error(element_id, msg);
    }
    $("#"+element_id).html(msg);
    //setTimeout( clean_msg_box(element_id), 50000);
}
function clean_msg_box(element_id){
    $("#"+element_id).html('');
}