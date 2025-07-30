#!/usr/bin/php
<?
	// ONLY CLI
	if (php_sapi_name() != "cli") exit("Command line Only.");
	
	// REQUIRE FILES (필수)
	require __DIR__ . "/../config.inc.php";
	require __DIR__ . "/../function.inc.php";
	
	$cli_start_time = getmicrotime();
	
	echo "Start: " . date("Y-m-d H:i:s") . "\n\n";
	
	
	
	echo "\n";
	echo "[Influxdata]\n";
	
	//Load Composer's autoloader
	require __DIR__ . "/../vendor/autoload.php";
	
use InfluxDB2\Client;
use InfluxDB2\Model\WritePrecision;
use InfluxDB2\Point;


// Initialize the Client

# You can generate an API token from the "API Tokens Tab" in the UI
$token = INFLUXDATA_TOKEN;
$org = '27d5bea03ed39a6d';
$bucket = 'datafirst';

$client = new Client([
    "url" => "https://us-west-2-1.aws.cloud2.influxdata.com",
    "token" => $token,
]);


// Write Data
$writeApi = $client->createWriteApi();

$point = Point::measurement('ga')
  ->addTag('host', 'host1')
  ->addField('used_percent', 23.43234543)
  ->addField('system_percent', 10.05)
  ->time(microtime(true));

$writeApi->write($point, WritePrecision::S, $bucket, $org);



// Dispose the Client
$client->close();

	
	
	
	
	
	
	echo "\n\n";
	echo "[MySQL DB Jobs]\n";
	
	// HOST
	$mysqli = mysqli_instance();
	
	$query = "SELECT id, name, calories FROM desserts";
	$query .= " WHERE calories >= 600";
	$query .= " ORDER BY name ASC";
	
	$res = $mysqli->query($query) or exit($mysqli->error);
	
	while ($row = $res->fetch_row()) {
		$id = $row[0];
		$name = $row[1];
		$calories = $row[2];
		
		echo $id . ":" . $name . "\n";
	}
	
	$mysqli->close();
	
	
	
	echo "\n";
	echo "End: " . date("Y-m-d H:i:s") . " (" . round((getmicrotime() - $cli_start_time) / 60, 2)  . "min)" . "\n";
?>