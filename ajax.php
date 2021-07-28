<?php 
error_reporting(0); 
$apiKey="xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";//这里的apiKey替换成你自己的，申请地址：https://apibug.cn/doc/dsp.html
//演示网址：https://www.apibug.com/jx/
$act=isset($_GET['act'])?$_GET['act']:null;
$url=isset($_GET['url'])?$_GET['url']:null;
preg_match_all('/(http|https|ftp)(.)*([a-z0-9\-\.\_])+/i', $url,$onlyurl);
//print_r($onlyurl);
$url = $onlyurl[0][0];
	switch($act){
		case 'dsp':

              $arr = array(
             'url'=>$url,
             'apiKey'=>$apiKey
            );
        //json也可以
        //$data_string =  json_encode($arr);
        //普通数组也行
        $data_string = $arr;

        $ch = curl_init("https://apibug.cn/api/dsp/");
        //避免https 的ssl验证
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSLVERSION, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        #ok
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);

$json = curl_exec($ch);
curl_close($ch);
//echo $json;

        $res = json_decode($json, true);
			$name = $res['data']['title'];//名称
			$img = $res['data']['img'];//图
			$img_run = $res['data']['img'];//缩略视频
			$video = $res['data']['videourl'];//无水印视频
			if(!empty($video)){
				echo '{"code":1,"msg":"解析成功","name":"'.$name.'","url":"'.$video.'","img":"'.$img.'","img_run":"'.$img_run.'"}';
			}else{
				echo '{"code":-1,"msg":"未知错误，可以尝试在试一次"}';
			}
		break;
	default:
		exit('{"code":0,"msg":"No Act"}');
	break;
	}	

    function w0ai1uoCurlGet($url, $idFllow=false, $UserAgent = '')
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        #关闭重定向
          if($idFllow){
              curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        }
          if($UserAgent){
              curl_setopt($curl, CURLOPT_USERAGENT, $UserAgent);
        }
      
      curl_setopt ($curl, CURLOPT_REFERER, $referer);
        #关闭SSL
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        #返回数据不直接显示
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    //Apibug Curl Post url结束
 ?>