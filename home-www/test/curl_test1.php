<?
	
	
	// Client URL
	$ch = curl_init();
	
	$url = "https://" . $_SERVER["HTTP_HOST"] . "/models/sys_login_log.php";
	$params = array("act" => "save", "login_id" => $login_id, "type" => "Session", "result" => 1, "location" => "로그인", "message" => "로그인 성공");
	
	echo $url;
	
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	
	$response = curl_exec($ch);
	
	var_dump($response);
	
	//$matchData = json_decode($response, true);
	
	curl_close($ch);
	
	
	/*
	// Client URL
	$ch = curl_init();
	
	$params = array("act" => "save", "login_id" => $login_id, "type" => "Session", "location" => "로그인", "message" => "로그인 성공");
	
	curl_setopt($ch, CURLOPT_URL, "https://demo.hemochart.com/models/sys_login_log.php");
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	
	$response = curl_exec($ch);
	
	var_dump($response);
	
	//$matchData = json_decode($response, true);
	
	curl_close($ch);
	*/
	
	
	/*
$data = array(
    'test' => 'test'
);
 
$url = "http://www.naver.com";
 
$ch = curl_init();                                 //curl 초기화
curl_setopt($ch, CURLOPT_URL, $url);               //URL 지정하기
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    //요청 결과를 문자열로 반환 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);      //connection timeout 10초 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);   //원격 서버의 인증서가 유효한지 검사 안함
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);       //POST data
curl_setopt($ch, CURLOPT_POST, true);              //true시 post 전송 
 
$response = curl_exec($ch);
curl_close($ch);
 
return $response;
 	*/
 	
 	/*
	// fetch match data
	$ch = curl_init();
	
	curl_setopt($ch, CURLOPT_URL, "/login.php");
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	
	$response = curl_exec($ch);
	
	var_dump($response);
	//$matchData = json_decode($response, true);
	
	curl_close($ch); 	
	*/
?>