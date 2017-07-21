<?php
$name=$_POST["name"];
$password=$_POST["password"];
$data = array("name"=>$name,'password'=>$password);
print_r(json_encode($data));
?> 