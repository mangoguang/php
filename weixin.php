<?php
ini_set("display_errors", "On");
error_reporting(E_ALL | E_STRICT);


// phpinfo();die;
$wechatReply = new wechatAutoReply();
// $wechatReply->replyText();
//$wechatReply->replyImage();
// $wechatReply->replyVideo();
$wechatReply->textReplyMsg();
// $wechatObj = new wechatCallbackapiTest();

// $wechatObj->responseMsg();



// 对文本消息的自动回复（回复内容包括：文本、图片、音频、视频、音乐）
// 此处的mediaId已经过期，需要到微信官方接口生成临时的mediaId或者获取微信永久素材的mediaId
class wechatAutoReply
{
    public function textReplyMsg(){
      
        $textArr = array(
                    array(
                        "verifyText"    =>  "熊猫",
                        array(
                                "msgType"   =>  "text",
                                "content"   =>  "大大的黑眼圈",
                            )
                    ),
                    array(
                        "verifyText"    =>  "小熊猫",
                        array(
                                "msgType"   =>  "image",
                                "mediaId"   =>  "NCM9XLYHQjJ1nr8RHDAeVCMvB-kr47WCu6pqdo0QeUXErn_bhZOgGK4ORmbCWXz7",
                            )
                    ),
                    array(
                        "verifyText"    =>  "熊猫打架",
                        array(
                                "msgType"   =>  "video",
                                "mediaId"  => "898MQj-m4FwC16DmS0bxu2enkIPVneabVPzJgA5mHAXz51BA2ZPajOGsoBdlb-IG",    
                                "title"     => "熊猫打架",
                                "desc"      => "三只熊猫的激烈战斗",      
                            )
                    ),
                    array(
                        "verifyText"    =>  "嗯嗯",
                        array(
                                "msgType"   =>  "voice",
                                "mediaId"   =>  "TwwGzslnNTa8lbR9m8hItcYTb2ilwJ6XqNGOPE-4KHnDeczIKlmM_lWmkVpNS99-",
                            )
                    ),
                    array(
                        "verifyText"    =>  "光芒",
                        array(
                                "msgType"   =>  "music",
                                "title"     =>  "光芒-朱克",
                                "desc"      =>  "一首让你燃起来的歌",                               
                                "musicUrl"  =>  "music.163.com/style/swf/widget.swf?sid=423407598&type=2&auto=1&width=320&height=66",
                                "HQMusicUrl"=>  "music.163.com/style/swf/widget.swf?sid=423407598&type=2&auto=1&width=320&height=66",
                                "mediaId"   =>  "AFAmqoCO_lamYtx22bB-U5KrNNqlJOiWki97JALBFTxmrj8IsTQr3U5GXva_10Ep",
                            )
                    ),
            );

        $defaultStr = "欢迎您使用慕思金管家。";

        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if(!empty($postStr)){
            // 验证xml文件是否安全
            libxml_disable_entity_loader(true);
            // 转换xml字符串为对象
            $postObj = simplexml_load_string($postStr,  "SimpleXMLElement", LIBXML_NOCDATA);   
            $content = $postObj->Content;
            // var_dump($postObj);die;             
        }
        foreach ($textArr as $key => $v) {
            if( $content == $v['verifyText']){
                switch ($v['0']['msgType']) {
                    case 'text':
                        $this->replyText($postObj, $v['0']['content']);
                        break;
                    
                    case 'image':
                        $this->replyImage($postObj, $v['0']['mediaId']);
                        break;
                    
                    case 'video':
                        $this->replyVideo($postObj, $v['0']['mediaId'], $v['0']['title'], $v['0']['desc']);
                        break;

                    case 'voice':
                        $this->replyVoice($postObj, $v['0']['mediaId']);
                        break;
                    case 'music':
                        $this->replyMusic($postObj, $v['0']['title'], $v['0']['desc'], $v['0']['musicUrl'], $v['0']['HQMusicUrl'], $v['0']['mediaId']);
                        break;    
                    default:
                        # code...
                        break;
                }
            } 
        }   
        $this->replyText($postObj, $defaultStr);
        
    }

 

    public function replyText($postObj, $content){
            $fromUserName = $postObj->ToUserName;
            $toUserName   = $postObj->FromUserName;        
            $createTime   = time();
            $textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[text]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        </xml>";
            
            $resultStr = sprintf($textTpl, $toUserName, $fromUserName, $createTime , $content);
            echo $resultStr;
       
    }

    public function replyImage($postObj, $mediaId){
            $fromUserName = $postObj->ToUserName;
            $toUserName   = $postObj->FromUserName;           
            $createTime   = time();
            $textTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[image]]></MsgType>
                            <Image>
                                <MediaId><![CDATA[%s]]></MediaId>
                            </Image>
                        </xml>";
            $resultStr = sprintf($textTpl, $toUserName, $fromUserName, $createTime, $mediaId);
            echo $resultStr;
    }

    public function replyVoice($postObj, $mediaId){
            $fromUserName = $postObj->ToUserName;
            $toUserName   = $postObj->FromUserName;            
            $createTime   = time();
            $textTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[voice]]></MsgType>
                            <Voice>
                                <MediaId><![CDATA[%s]]></MediaId>
                            </Voice>
                        </xml>";
            $resultStr = sprintf($textTpl, $toUserName, $fromUserName, $createTime, $mediaId);
            echo $resultStr;
    }

    public function replyVideo($postObj, $mediaId, $title, $desc){
            $fromUserName = $postObj->ToUserName;
            $toUserName   = $postObj->FromUserName;         
            $createTime   = time();
            $textTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[video]]></MsgType>
                            <Video>
                                <MediaId><![CDATA[%s]]></MediaId>
                                <Title><![CDATA[%s]]></Title>
                                <Description><![CDATA[%s]]></Description>
                            </Video> 
                        </xml>";
                     
            $resultStr = sprintf($textTpl, $toUserName, $fromUserName, $createTime, $mediaId, $title, $desc);
            echo $resultStr;
    }



    public function replyMusic($postObj, $title, $desc, $mediaId, $musicUrl, $HQMusicUrl){
            $fromUserName = $postObj->ToUserName;
            $toUserName   = $postObj->FromUserName;         
            $createTime   = time();
            $textTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[music]]></MsgType>
                            <Music>
                                <Title><![CDATA[%s]]></Title>
                                <Description><![CDATA[%s]]></Description>
                                <MusicUrl><![CDATA[MUSIC_Url]]></MusicUrl>
                                <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
                                <ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
                            </Music>
                        </xml>";
                     
            $resultStr = sprintf($textTpl, $toUserName, $fromUserName, $createTime, $title, $desc, $musicUrl , $HQMusicUrl, $mediaId);
            echo $resultStr;
    }

    // 回复图文消息   

}
  
//这个类只是参考没用到       
class wechatCallbackapiTest
{        

        public function responseMsg()
        {
            $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
            if(!empty($postStr)){
                // simplexml_load_string:将xml字符串转换为SimpleXMLElement对象，
                // 参数1：字符串
                // 参数2：对象名
                // 参数3：将 CDATA 设置为文本节点（CDATA：XML标签中的文本数据）
                $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA); 
                // 得到消息类型
                $RX_TYPE = trim($postObj->MsgType);
                // 大写改为小写，判断消息类型从而处理
                switch(strtolower($RX_TYPE)){
                    case "text":
                        $resultStr = $this->handleText($postObj);//文本处理
                        break;
                    case "event":
                        $resultStr = $this->handleEvent($postObj);//事件处理
                        break;
                    default:
                        $resultStr = "Unknow msg type:".$RX_TYPE;
                        break;
                }
                echo $resultStr;
            }else{
                echo "";
                exit;
            }
        }
        
        //接收用户的文本消息并回复
        public function handleText($postObj){
            $fromUserName = $postObj->ToUserName;
            $toUserName   = $postObj->FromUserName;
            $content      = trim($postObj->Content);
            $createTime   = time();
            $textTpl      = "<xml>
                             <ToUserName><![CDATA[%s]]></ToUserName>
                             <FromUserName><![CDATA[%s]]></FromUserName>
                             <CreateTime>%s</CreateTime>
                             <MsgType><![CDATA[%s]]></MsgType>
                             <Content><![CDATA[%s]]></Content>
                             </xml>";
            if(!empty($content)){
                $msgType = "text";
                $contentStr = "欢迎您使用慕思金管家。";
                $resultStr = sprintf($textTpl, $toUserName, $fromUserName, $createTime, $msgType, $contentStr);
                echo $resultStr;
            }else{
                echo "Input Something...";
            }                                       
        }


        //接收用户的事件消息并回复
        public function handleEvent($object){
            $contentStr = "";
            switch($object->Event){
                case "subscribe":
                    $contentStr = "尊敬的用户，感谢您关注慕思寝具微信服务号。请通过“我的慕思-个人中心”进入绑定页面完成绑定。";
                    break;
                // 取消关注默认不会回复用户
                case "unsubscribe":
                    $contentStr = "您已取消关注";
                    break;
                //default:
                //  $contentStr = "Unknow Event:".$object->Event;
                //  break;
            }
            $resultStr = $this->responseText($object,$contentStr);
            return $resultStr;
        }

        public function responseText($object,$content){
            $fromUserName = $object->ToUserName;
            $toUserName   = $object->FromUserName;
            $createTime   = time();
            $textTpl = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[text]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        </xml>";
            $resultStr = sprintf($textTpl, $toUserName, $fromUserName, $createTime, $content);
            echo $resultStr;
        }
}    



// include_once("mem.php");

// $token = mem_token();
// //$token = $token['access_token'];

// $url = "https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=".$token."&type=video";


// $data = array();

// $data['type'] = "news";
// $data['offset'] = 0;
// $data['count'] = 1;
    

// $json = json_encode($data,  JSON_UNESCAPED_UNICODE);

// var_dump($json);

// $output = post($url, $json);
// var_dump($output);

// function post($url, $data){

//   $ch = curl_init();

//   curl_setopt($ch, CURLOPT_URL, $url);

//   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//   //声明使用post方式进行发送
//   curl_setopt($ch, CURLOPT_POST, 1);

//   //发送的数据
//   curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

//   //跳过证书验证
//   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
//   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 


//   curl_setopt($ch, CURLOPT_HEADER, 0);

//   curl_setopt($ch, CURLOPT_TIMEOUT, 500);
  
//   $output = curl_exec($ch);

//   curl_close($ch);
    
//   return $output;

// }

