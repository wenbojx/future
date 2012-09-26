<?php

$start = file_get_contents('num.txt');
$start = $start+1;
$end = $start+10;
$str = '';
//for ($i = 5127410; $i>0; $i-- ){
for ($i = $start; $i<=$end; $i++ ){
    $prefix = substr($i, -2);
    if($prefix == '0'){
        sleep(2);
    }
    $prefix = substr($i, -2);
    if($prefix == '00'){
        sleep(5);
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
        $str .= "--XX--:".$i."\n";
        continue;
    }
    $truename = $result['content']['truename'];
    $email = $result['content']['email'];
    $mobile = $result['content']['mobile'];
    $u_id = $result['content']['uid'];
    //print_r($result);
    //unset($data);
    //$data = json_encode($result);

    $conn = @mysql_connect("localhost","root","wenbojx0513");
    if (!$conn){
        die("连接数据库失败：" . mysql_error());
    }

    mysql_select_db("members", $conn);
    mysql_query("set names 'utf8'");	//PHP 文件为 utf-8 格式时使用

    $sql = "INSERT INTO member(id, content, 'truename', 'email', 'mobile')VALUES(null, '{$data}', '{$truename}', '{$email}', '{$mobile}')";
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
file_put_contents('num.txt', $u_id);

exit();

