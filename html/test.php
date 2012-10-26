<?php
$file = '/var/www/num.txt';
$start = file_get_contents($file);
$add_num = 30;
$start = $start+1;
$end = $start+$add_num;
$str = '';
$datas_mysql = array();
//for ($i = 5127410; $i>0; $i-- ){
$j = 0;
for ($i = $start; $i<=$end; $i++ ){

/*     if($end >=5127410){
        continue;
    } */
    $prefix = substr($i, -2);
    if($prefix == '0'){
        sleep(1);
    }
    //$prefix = substr($i, -2);

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
    if(!$result || !$result['content']){
        $str .= "--XX--:".$i."\n";
        continue;
    }
    $uid = $result['content']['uid'];
    $truename = $result['content']['truename'];
    $email = $result['content']['email'];
    $mobile = $result['content']['mobile'];
    $u_id = $result['content']['uid'];

    $datas_mysql[$j]['u_id'] = $u_id;
    $datas_mysql[$j]['data'] = $data;
    $datas_mysql[$j]['truename'] = $truename;
    $datas_mysql[$j]['email'] = $email;
    $datas_mysql[$j]['mobile'] = $mobile;
    $j++;

    //sleep(1);
}
if($datas_mysql){
    $sql = "INSERT INTO `member` (`id`, `uid` ,`content` ,`truename` ,`email` ,`mobile`) VALUES ";
    foreach($datas_mysql as $v){
        $sql .= "(NULL ,'{$v['u_id']}', '{$v['data']}', '{$v['truename']}', '{$v['email']}', '{$v['mobile']}'),";
    }
    $sql = substr($sql, 0, strlen($sql)-1).';';
    echo $sql;
    $conn = @mysql_connect("localhost","root","wenbojx0513");
    if (!$conn){
        die("连接数据库失败：" . mysql_error());
    }

    mysql_select_db("members", $conn);
    mysql_query("set names 'utf8'");	//PHP 文件为 utf-8 格式时使用
    mysql_query($sql,$conn);
}


if(!$u_id || $u_id=='0' || $u_id== '' || $u_id<10 ){
    $u_id = $end+5;
}
//file_put_contents('a.txt', $str);
file_put_contents($file, $u_id);

exit();

