<?php
header("Content-Type:text/html;charset=utf-8");
if(null!==$_POST["id"]||null!==$_GET["id"]){
	if(null!==$_POST["id"]) $id=$_POST["id"]; else $id=$_GET["id"];
	$url="http://www.freshman.ecnu.edu.cn/szyx/zzfw/sso_zhifu.jsp?userId=".$id."&userName=123"; 
	$contents = file_get_contents($url); 
	$location=strpos($contents,"document.location.href='")+24;
	$url=substr($contents,$location,strpos($contents,"';</script>")-$location);
	$contents = file_get_contents($url); 
	$cookies = array();
	foreach ($http_response_header as $hdr) {
		if (preg_match('/^Set-Cookie:\s*([^;]+)/', $hdr, $matches)) {
			parse_str($matches[1], $tmp);
			$cookies += $tmp;
		}
	}
	$opts = array('http' => array('header'=> 'Cookie:JSESSIONID=' .$cookies["JSESSIONID"]."\r\n"));
	$context = stream_context_create($opts);
	$contents= file_get_contents("http://pay.ecnu.edu.cn/pay/index.html", false, $context);
	$location=strpos($contents,'height:46px">')+13;
	$name=substr($contents,$location,strpos($contents,"，您好</div>")-$location);
	if($name=="123")$name="查无此人！";
	echo $name;
}else{
	echo "请输入学号！";
}
?>