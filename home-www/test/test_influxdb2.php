#!/usr/bin/php
<?
	// ONLY CLI
	if (php_sapi_name() != "cli") exit("Command line Only.");
	
	// FUNCTION INCLUDE
	require __DIR__ . "/../prod/config.inc.php";
	require __DIR__ . "/../prod/function.inc.php";
	
	echo "TEST INFLUXDB2 Start: " . date("Y-m-d H:i:s") . "\n\n\n";
	
	
use InfluxDB2\Client;
use InfluxDB2\WriteType as WriteType;

# You can generate a Token from the "Tokens Tab" in the UI
$token = 'AuGen9c4scgBONy9m3qRLIYFJmR9nbMeTyf6FQqze49kPhHkywV72-kUwdmrTqEix9zJgAeRgB_EgE_odLVnhQ==';
$org = 'devTeam';
$bucket = 'datafirst';

$client = new Client([
    "url" => "http://influxdb2.datafirst.co.kr:8086",
    "token" => $token,
]);

	
	
$writeApi = $client->createWriteApi();

$data = "test-php-cli,host=host1 used_percent=23.43234543";

$writeApi->write($data, InfluxDB2\Model\WritePrecision::S, $bucket, $org);	
	
	
	
	
	echo "TEST INFLUXDB2 End: " . date("Y-m-d H:i:s") . "\n";
?>