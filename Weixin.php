<?
define(Token,'shengbian_hymm91');
class Weixin
{

	
	function index()
		{	
			
			$signature = $_GET["signature"];
			$timestamp = $_GET["timestamp"];
			$nonce = $_GET["nonce"];	
			$echostr = $_GET["echostr"];
			$token = Token;
			$tmpArr = array($token, $timestamp, $nonce);
			
			sort($tmpArr, SORT_STRING);
			$tmpStr = implode( $tmpArr );
			$tmpStr = sha1( $tmpStr );
		    
			if( $tmpStr != $signature )
			{
				return;
			}
			if($_SERVER['REQUEST_METHOD'] == "POST")
			{
				$txetreply = $this-> txetreply();
			}else{
				echo $echostr;
			}
			
			
			
			
		}
		
	
		
	function txetreply()
		{	
		
			$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
			if (!empty($postStr))
			{  
                $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);  
                $fromUsername = $postObj->FromUserName;  
                $toUsername = $postObj->toUsername; 
                $keyword = trim($postObj->Content);  
				$type = $postObj->MsgType;
				$custom = $postObj->Event;
                $time = time();  
                $textTpl = "<xml>  
                            <ToUserName><![CDATA[%s]]></ToUserName>  
                            <FromUserName><![CDATA[%s]]></FromUserName>  
                            <CreateTime>%s</CreateTime>  
                            <MsgType><![CDATA[%s]]></MsgType>  
                            <Content><![CDATA[%s]]></Content>  
							<FuncFlag>0</FuncFlag> 
                            </xml>"; 
							
				if($type == "event" && $custom == "subscribe")
				{
					$msgType = "text";  
                    $contentStr = "你好";  
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);  
                    echo $resultStr;  
				}
				if($keyword == "1")  
				{  
				$msgType = "text";  
                $contentStr = "hello";  
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);  
                echo $resultStr;  
				}  
			}
	

		}

/*
	function user()
	{
		$code = $_GET['code'];  
		$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=appid&secret=SECRET&code=$code&grant_type=authorization_code"; 
		$json = file_get_contents($url);  
		$arr = json_decode($json,true);  
		$token = $arr['access_token'];  

		$openid = $arr['openid'];  
		$url = "https://api.weixin.qq.com/sns/userinfo?access_token=$token&openid=$openid ";  
		$json = file_get_contents($url); 
		$arr = json_decode($json,true);
		$subscribe = $arr['subscribe'];
		$openid  = $arr['openid '];
		$name = $arr['nickname']; 
		$sex = $arr['sex'];
		$city= $arr['city'];
		$country= $arr['country'];
		$province = $arr['province '];
		$language = $arr['language '];
		$imgURL = $arr['headimgurl'];
		$subscribe_time = $arr['subscribe_time'];
		$unionid  = $arr['unionid '];
		$remark  = $arr['remark '];
		$groupid   = $arr['groupid'];		
	}
	*/
}

