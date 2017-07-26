<?php
//定义变量
$name=$_POST["name"];
$password=$_POST["password"];
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

if(sizeof($row)==1){
  $data = array("name"=>$name,'status'=>'success');
  $setSql="insert into users values(1,'".$name."',".$password.")";//新增一行数据
  mysql_query($setSql);
  mysql_close(); //关闭MySQL连接
}else{
  $data = array("name"=>$name,'status'=>'error');
}
print_r(json_encode($data));
?> 