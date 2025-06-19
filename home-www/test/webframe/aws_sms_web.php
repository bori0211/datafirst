<?
	require "../vendor/autoload.php";
	
	use Aws\Sns\SnsClient;
	use Aws\Exception\AwsException;
	
	$credentials = new Aws\Credentials\Credentials("AKIARH6Z3C3ZV3HQOS5F", "dY5B5zR2wMAEY4P0j3OFSMjgpRb784tNpbF5vRgz");
	
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