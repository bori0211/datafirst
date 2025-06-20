#!/usr/bin/php
<?
	require "../vendor/autoload.php";
	
	use Aws\Sns\SnsClient;
	use Aws\Exception\AwsException;
	
	$SnSclient = new SnsClient([ "region" => "ap-northeast-1", "version" => "latest" ]);
	$message = "PHP TEST ¹ß¼Û";
	$phone = "+82 1052500120";
	
	try {
		$result = $SnSclient->publish([ "Message" => $message, "PhoneNumber" => $phone, ]);
		var_dump($result);
	} catch (AwsException $e) {
		error_log($e->getMessage());
	}
?>