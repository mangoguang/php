<?php
$name=$_POST["name"];
$password=$_POST["password"];
if($name == 'mangoguang'&&$password == '123456'){
  $data = array("name"=>$name,'status'=>'success');
}else{
  $data = array("name"=>$name,'status'=>'error');
}
print_r(json_encode($data));
?> 