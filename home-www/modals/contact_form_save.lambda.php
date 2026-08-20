<?
	// REQUIRE FILES (필수)
	require "../config.inc.php";
	require "../set_init_data.inc.php";
	
	header("Content-Type: application/json; charset=utf-8");
	
	
	
	/*
	$msg = date("Y-m-d H:i:s") . " 접수" . "\n\n";
	$msg .= "병원: " . $_POST["hospital"] . "\n";
	$msg .= "지역: " . $_POST["local"] . "\n";
	$msg .= "연락처: " . $_POST["contact"] . "\n";
	$msg .= "내용: " . $_POST["content"] . "\n";
	
	$to = "contact@hemochart.com";
	$subject = "[홈페이지] 문의";
	$headers = "From: contact@hemochart.com";
	
	if (mail($to, $subject, $msg, $headers))
		echo '{"result": true}';
	else
		echo '{"result": false}';
	*/
	
	
	
	// Client URL
	$ch = curl_init();
	
	//$url = "https://express.datafirst.co.kr/lambda/sendmail";
	$url = "https://frcmjfigdrg2mnw3x44bxy2zr40hdfdk.lambda-url.ap-northeast-2.on.aws/";
	
	$params = array("date" => date("Y-m-d H:i:s"), "병원" => $_POST["hospital"], "지역" => $_POST["local"], "연락처" => $_POST["contact"], "내용" => $_POST["content"]);
	$params_json = json_encode($params);
	
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=utf-8"));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $params_json);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	
	$response = curl_exec($ch);
	
	//var_dump($response);
	
	curl_close($ch);
	
	
	
	$responseData = json_decode($response, true);
	
	if ($responseData["result"])
		echo '{"result": true}';
	else
		echo '{"result": false}';
?>