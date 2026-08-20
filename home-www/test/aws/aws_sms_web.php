<?
	require "../vendor/autoload.php";
	
	use Aws\Sns\SnsClient;
	use Aws\Exception\AwsException;
	
	$credentials = new Aws\Credentials\Credentials(TEST_ACCESS_KEY_ID, TEST_SECRET_ACCESS_KEY);
	
	$SnSclient = new SnsClient([ "region" => "ap-northeast-1", "version" => "latest", "credentials" => $credentials ]);
	$message = "PHP TEST 발송";
	$phone = "+82 1052500120";
	
	try {
		$result = $SnSclient->publish([ "Message" => $message, "PhoneNumber" => $phone, ]);
		var_dump($result);
	} catch (AwsException $e) {
		error_log($e->getMessage());
	}
?>