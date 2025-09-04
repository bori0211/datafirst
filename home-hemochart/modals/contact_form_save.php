<?
	// REQUIRE FILES (필수)
	require "../config.inc.php";
	require "../set_init_data.inc.php";
	
	header("Content-Type: application/json; charset=utf-8");
	
	
	
	$msg = date("Y-m-d H:i:s") . " 접수" . "\n\n";
	$msg .= "병원: " . $_POST["hospital"] . "\n";
	$msg .= "지역: " . $_POST["local"] . "\n";
	$msg .= "연락처: " . $_POST["contact"] . "\n";
	$msg .= "내용: " . $_POST["content"] . "\n";
	
	$to = "bori0211@gmail.com";
	//$to = "ec2-user@localhost";
	$subject = "[HemoChart] Contact";
	$headers = "From: contact@hemochart.com";
	
	
	
	//Load Composer's autoloader
	require "../vendor/autoload.php";
	
	//Import PHPMailer classes into the global namespace
	//These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	
	//Create an instance; passing `true` enables exceptions
	$mail = new PHPMailer(true);
	
	try {
		//Server settings
		//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                  //Enable verbose debug output
		$mail->isSMTP();                                          //Send using SMTP
		$mail->Host       = "smtp.gmail.com";                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                 //Enable SMTP authentication
		$mail->Username   = "datafirst.contact@gmail.com";        //SMTP username
		$mail->Password   = GMAIL_DATAFIRST_PASSWORD;             //SMTP password
		//$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;        //Enable implicit TLS encryption
		$mail->SMTPSecure = "tls";
		$mail->Port       = 587;                                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
		
		//Recipients
		$mail->setFrom("datafirst.contact@gmail.com", "HemoChart");
		$mail->addAddress("bori0211@gmail.com");     	     	 //Add a recipient
		$mail->addAddress("kevinlee0508@hanmail.net");           //Add a recipient
		//$mail->addAddress('ellen@example.com');                //Name is optional
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