<?php
$secret = md5('YOKA.COM.USER'.(string)date('l-F'));

$http_method = "get";
$params = array();
$params['method'] = 'GetUserDataByUid';
$params['format'] = "json"; // 这里是返回数据的类型：php(是序列化数据)，json,xml
//$params['uid'] = 5127410;
$params['uid'] = 5038799;
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
echo $request_url."\n\n";

exit();


$conn = @mysql_connect("localhost","root","wenbojx0513");
if (!$conn){
    die("连接数据库失败：" . mysql_error());
}

mysql_select_db("members", $conn);
mysql_query("set names 'utf8'");	//PHP 文件为 utf-8 格式时使用
$sql = "select * from member where id>=10000 and id<20000";
$results = mysql_query($sql);                //得到查询结果数据集

//循环从数据集取出数据
while( $row = mysql_fetch_array($results) ){
    $id = $row['id'];
    $result = json_decode($row['content'], true);
    $uid = $result['content']['uid'];
    $truename = $row['truename'] ? $row['truename'] : $result['content']['truename'];
    $email = $row['email'] ? $row['email'] : $result['content']['email'];
    $mobile = $row['mobile'] ? $row['mobile'] : $result['content']['mobile'];
    $sql = "UPDATE `member` SET `uid` = '{$uid}', `truename` = '{$truename}', `email`='{$email}',`mobile`='{$mobile}' WHERE `id` ={$id} LIMIT 1;";
    echo $sql."\n";
    $s = mysql_query($sql);
}