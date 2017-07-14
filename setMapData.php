<?php
// if(!$_POST["id"]){
//   $name=$_POST["name"];
// }else{
//   $name='guang';
// }
// header("Content-type:text/json");
$name='guang';
//$id=$_POST["id"];
//$name=$_POST["name"];
// $address=$_POST["address"];
// $phone=$_POST["phone"];
// $jingdu=$_POST["jingdu"];
// $weidu=$_POST["weidu"];
// $data = array("id"=>$id,"name"=>$name,"phone"=>$phone,"address"=>$address,"jingdu"=>$jingdu,"weidu"=>$weidu);
// print_r(json_encode($data));
$data = array("name"=>$name);
print_r(json_encode($data));

  // $con = mysql_connect("localhost:3308","root","derucci123");
  // if(!$con){
  //   die('Could not connect: ' . mysql_error());
  // }
  // mysql_select_db("map_db", $con);

  // $sql="select * from user where Id_P='2'";

  // $result = mysql_query($sql) or die(mysql_error());
  // $row = mysql_fetch_array($result);

  // $person=array("id"=>$row[0],"name"=>$row[1],"address"=>$row[2]);

  // $text = json_encode($person);

  //  print_r ( $text);
?> 