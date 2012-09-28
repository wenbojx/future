<?php
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