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