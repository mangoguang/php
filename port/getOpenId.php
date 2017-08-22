<?php
//header('Access-Control-Allow-Origin: *');
  $code=$_POST["code"];
  //发起https请求
  $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx879c920191311570&secret=b3b02a19a87826ee3d78340250df3daa&code='.$code.'&grant_type=authorization_code ';
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_HEADER, 0);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//这个是重点。
  $data = curl_exec($curl);
  curl_close($curl);
  //将stdClass Object转成array
  $json_obj = json_decode($data,true);
  //将array转成json数据
  $json = array("access_token"=>$json_obj['access_token'],'openid'=>$json_obj['openid']);

  print_r(json_encode($json));
?> 