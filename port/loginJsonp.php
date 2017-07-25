<?php
header('Content-type: application/json');  
//获取回调函数名  
$jsoncallback = htmlspecialchars($_REQUEST ['jsoncallback']);//把预定义的字符转换为 HTML 实体。

//定义变量
$name=$_GET["name"];
$password=$_GET["password"];

//登陆数据库
$con = mysql_connect("localhost:3308","root","derucci123");
//连接失败时报错
if(!$con){
  die('Could not connect: ' . mysql_error());
}
//连接map_db数据库
mysql_select_db("map_db", $con);
$sql="select * from users where m_userName = '".$name."'";//SQL语句
$result = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_array($result); 

if($name == $row[1]&&$password == $row[2]){
  $data = array("name"=>$name,'status'=>'success');
}else{
  $data = array("name"=>$name,'status'=>'error');
}
$json_data=json_encode($data);//转换为json数据 
print_r($jsoncallback."(".$json_data.")");
?> 