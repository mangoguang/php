<?php
// $access_token = 'wKAYC_Clo20Za2PFuHruioi2ONXgWHaYFLRyvFoK4GQTviuOAnx61Za8UaV9E1o5Ai8wCutpFA32-XSWN4oqellgBL9eLkygwq1Uxzkcium3bPw5FYdXmxvSHVX8RLJmLWTdAAAUFC';
// $access_token = 'gcZdM7gWTaZkFSTEFXkRriYh21889DzGjW1QozEgPe48_MGBMYbQ5M-EVD98zQ6K4yNbP4AWOU_gcAZtezcxMA';
  //初始化
  // $curl = curl_init();
  // //设置抓取的url
  // curl_setopt($curl, CURLOPT_URL, 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=wKAYC_Clo20Za2PFuHruioi2ONXgWHaYFLRyvFoK4GQTviuOAnx61Za8UaV9E1o5Ai8wCutpFA32-XSWN4oqellgBL9eLkygwq1Uxzkcium3bPw5FYdXmxvSHVX8RLJmLWTdAAAUFC');
  // // curl_setopt($curl, CURLOPT_URL, 'http://10.11.8.237/php/port/login.php');
  // //设置头文件的信息作为数据流输出
  // curl_setopt($curl, CURLOPT_HEADER, 1);
  // //设置获取的信息以文件流的形式返回，而不是直接输出。
  // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  // //设置post方式提交
  // curl_setopt($curl, CURLOPT_POST, 1);
  // //设置post数据
  // $post_data = json_encode(array(
  //     "touser" => "oF0GEwsP7TJ5UCn9sRBpjsENhq2k",
  //     "msgtype" => "text",
  //     "text" => array(
  //         "content" => "Hello mango"
  //       )
  //     ));
  // curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
  // //执行命令
  // $data = curl_exec($curl);
  // //关闭URL请求
  // curl_close($curl);
  // //显示获得的数据

  // // //将stdClass Object转成array
  // // $json_obj = json_decode($data,false);
  // // // //将array转成json数据
  // // $json = array("name"=>$json_obj['name'],'password'=>$json_obj['password']);

  // print_r($data);

// $post_data = json_encode(array(
//       "touser" => "oF0GEwsP7TJ5UCn9sRBpjsENhq2k",
//       "msgtype" => "text",
//       "text" => array(
//           "content" => "Hello mango"
//         )
//       ));

// $post_data = '{"touser": "oF0GEwsP7TJ5UCn9sRBpjsENhq2k","msgtype": "text","text": {"content": "Hello World"}}';
$post_data = '{
    "touser":"oF0GEwsP7TJ5UCn9sRBpjsENhq2k",
    "msgtype":"news",
    "news":{
        "articles": [
         {
             "title":"Happy Day",
             "description":"Is Really A Happy Day",
             "url":"https://derucci.net/t6/focus.html",
             "picurl":"http://derucci.net/t6/9919.png"
         },
         {
             "title":"Happy Day",
             "description":"Is Really A Happy Day",
             "url":"https://derucci.net/t6/focus.html",
             "picurl":"http://derucci.net/t6/9919.png"
         }
         ]
    }
}';

$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=4awDbbkhmFPzFc1qyvBCWz3j86ItG-zIx6ctXW_wN-4EuozKQqDnaAlykF0flVAWYutRXfc5LNJmV328LNv8nUxumiCGjfP3NIiLd_fIGhL3YgX3YdZpojTp0x_emgVMKWXiAJAPBC";

// $post_data = array(
//       "name" => "mango",
//       "password" => "123456"
//       );
// $url = "http://10.11.8.237/php/port/login.php";

$data = post($url, $post_data);
$arr = json_decode($data,true);
var_dump($arr);


function post($url, $data){

  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, $url);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  //声明使用post方式进行发送
  curl_setopt($ch, CURLOPT_POST, 1);

  //发送的数据
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

  //跳过证书验证
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 


  curl_setopt($ch, CURLOPT_HEADER, 0);

  curl_setopt($ch, CURLOPT_TIMEOUT, 500);
  
  $output = curl_exec($ch);

  curl_close($ch);
    
  return $output;

}


?> 
