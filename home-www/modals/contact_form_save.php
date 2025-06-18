<?
	// REQUIRE FILES (필수)
	require __DIR__ . "/../config.inc.php";
	require __DIR__ . "/../set_init_data.inc.php";
	
	header("Content-Type: application/json; charset=utf-8");
	
	
	
	$msg = date("Y-m-d H:i:s") . " 접수" . "\n\n";
	$msg .= "회사명: " . $_POST["company"] . "\n";
	$msg .= "지역: " . $_POST["local"] . "\n";
	$msg .= "연락처: " . $_POST["contact"] . "\n";
	$msg .= "내용: " . $_POST["content"] . "\n";
	
	$to = "datafirst.contact@gmail.com";
	//$to = "ec2-user@localhost";
	$subject = "[DataFirst] Contact";
	$headers = "From: datafirst.contact@gmail.com";
	
	/*
	if (mail($to, $subject, $msg, $headers))
		echo '{"result": true}';
	else
		echo '{"result": false}';
	*/
	
	
	
	/*
	// Client URL
	$ch = curl_init();
	
	$url = "https://express.datafirst.co.kr/lambda/sendmail";
	
	$params = array("date" => date("Y-m-d H:i:s"), "회사명" => $_POST["company"], "지역" => $_POST["local"], "연락처" => $_POST["contact"], "내용" => $_POST["content"]);
	$params_json = json_encode($params);
	
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
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
	*/
	
	
	
	//Import PHPMailer classes into the global namespace
	//These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	
	//Load Composer's autoloader
	require __DIR__ . "/../vendor/autoload.php";
	
	//Create an instance; passing `true` enables exceptions
	$mail = new PHPMailer(true);
	
	try {
		//Server settings
		//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                  //Enable verbose debug output
		$mail->isSMTP();                                          //Send using SMTP
		$mail->Host       = "smtp.gmail.com";                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                 //Enable SMTP authentication
		$mail->Username   = "chickendinner.me@gmail.com";         //SMTP username
		$mail->Password   = GMAIL_CHICKENDINNER_PASSWORD;         //SMTP password
		//$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;        //Enable implicit TLS encryption
		$mail->SMTPSecure = "tls";
		$mail->Port       = 587;                                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
		
		//Recipients
		$mail->setFrom("chickendinner.me@gmail.com", "ChickenDinner");
		$mail->addAddress("bori0211@gmail.com", "DataFirst");     //Add a recipient
		//$mail->addAddress('ellen@example.com');               //Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');
		
		//Attachments
		//$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
		
		//Content
		$mail->isHTML(false);                                    //Set email format to HTML
		$mail->Subject = $subject;
		$mail->Body    = $msg;
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		
		$mail->send();
		
		echo '{"result": true}';
		
	} catch (Exception $e) {
		
		//echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		echo '{"result": false}';
	}	
?>