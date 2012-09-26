<?php
//$str = '{"content":{"uid":"5012705","sex":"0","email":"shenhbo1989@126.com","newemail":"","emailcheck":"0","mobile":"","qq":"","msn":"","msnrobot":"","msncstatus":"0","videopic":"","birthyear":"0","birthmonth":"0","birthday":"0","blood":"","marry":"0","birthprovince":"","birthcity":"","resideprovince":"","residecity":"","note":"","spacenote":"","authstr":"","theme":"","nocss":"0","menunum":"0","css":"","privacy":"","friend":"","feedfriend":"","sendmail":"","magicstar":"0","magicexpire":"0","timeoffset":"","marriage":"0","education":"0","income":"0","address":"","postalcode":"","phone":"","industry":"0","constellation":"0","blood_type":"0","intro":"","realname":"","nickname":"","brand":null,"brand_other":null,"brand_loc":null,"brand_prink":null,"magazine":null,"magazine_other":null,"cosmetic_type":null,"cosmetic_brand":null,"conmetic_other":null,"hobby":null,"hobby_other":null,"music":null,"movie":null,"tv":null,"book":null,"idol":null,"favorite_more":null,"home_income":"0","fashion_year_consume":"0","beauty_year_consume":"0","beauty_month_consume":"0","travel_year_consume":"0","hair":"0","hair_type":"0","eye":"0","skin_type":"0","shop":"","shop_url":"","shop_desc":"","daren_enounce":"","daren":"0","source":"0","source_other":"","sign":"","mood":"","mood_time":"0","system_msg_all":null,"system_msg_condi":null,"prink_custom":"0","product":"","buy_mode":"0","nurse_mode":"0","beauty_times":"0","network_custom":"0","try_new":"1","try_report":"1","newproduct_mode":"0","bbs":"","pinyin":null,"default_location":"0","default_sublocation":"0","read_help":"0","new_navigation":"1","readedloginmsg":"0","check_mobile":"0","album_default_pic":null,"userinfo_type":"0","street_type":"0","namestatus":"0","username":"a407711505","truename":"","blog_coll_count":"0","photo_coll_count":"0","bbs_coll_count":"0","avatar":"0","dateline":"1348184357"},"start_time":"2012-09-26 00:12:42","end_time":"2012-09-26 00:12:42"}';
//print_r(json_decode($str,true));
//exit();

$start = file_get_contents('num.txt');
$start = $start+1;
$end = $start+50;
$str = '';
//for ($i = 5127410; $i>0; $i-- ){
for ($i = $start; $i<=$end; $i++ ){
    $prefix = substr($i, -2);
    if($prefix == '0'){
        sleep(2);
    }
    $prefix = substr($i, -2);
    if($prefix == '00'){
        sleep(4);
    }


    $secret = md5('YOKA.COM.USER'.(string)date('l-F'));

    $http_method = "get";
    $params = array();
    $params['method'] = 'GetUserDataByUid';
    $params['format'] = "json"; // 这里是返回数据的类型：php(是序列化数据)，json,xml
    //$params['uid'] = 5127410;
    $params['uid'] = $i;
    $params['sign'] = 1;

    $request_url = "http://space.yoka.com/services/user/uc_user.php";

    if ($params && is_array($params))
    {
        ksort($params);
        $secret_code = $secret;
        foreach ($params as $key => $value)
        {
            if ($key != 'sign')
            {
                $secret_code .= $key.$value;
            }
        }
        $params['sign'] = strtoupper(md5($secret_code));
    }

    $request_url .= "?". http_build_query($params);
    //echo $request_url."\n\n";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $request_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    //$data = addslashes($data);

    $result = json_decode($data, true);
    if(!$result){
        continue;
    }
    $truename = $result['content']['truename'];
    $email = $result['content']['email'];
    $mobile = $result['content']['mobile'];
    //print_r($result);
    //unset($data);
    //$data = json_encode($result);

    $conn = @mysql_connect("localhost","root","wenbojx0513");
    if (!$conn){
        die("连接数据库失败：" . mysql_error());
    }

    mysql_select_db("members", $conn);
    mysql_query("set names 'utf8'");	//PHP 文件为 utf-8 格式时使用

    $sql = "INSERT INTO member(id, content, 'truename', 'email', 'mobile')VALUES(null, '{$data}'), '{$truename}', '{$email}', '{$mobile}'";
    echo $sql."\n\n";                       //退出程序并打印 SQL 语句，用于调试
    if(!mysql_query($sql,$conn)){
        $str .= "--X--:".$i."\n";
    } else {
        $str .= "--Y--:".$i."\n";
    }
    echo $str;

    //sleep(1);
}
//file_put_contents('a.txt', $str);
//file_put_contents('num.txt', $end);

exit();

