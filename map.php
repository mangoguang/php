<?php
  $con = mysql_connect("localhost:3308","root","derucci123");
  if(!$con){
    die('Could not connect: ' . mysql_error());
  }
  mysql_select_db("map_db", $con);

  $sql="select * from user where Id_P='2'";

  $result = mysql_query($sql) or die(mysql_error());
  $row = mysql_fetch_array($result);

  $person=array("id"=>$row[0],"name"=>$row[1],"address"=>$row[2]);

  $text = json_encode($person);

   print_r ( $text);
?> 