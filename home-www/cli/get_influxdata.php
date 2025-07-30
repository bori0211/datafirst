#!/usr/bin/php
<?php
	// ONLY CLI
	if (php_sapi_name() != "cli") exit("Command line Only.");
	
	// REQUIRE FILES (필수)
	require __DIR__ . "/../config.inc.php";
	require __DIR__ . "/../function.inc.php";
	
	// COMPOSER AUTOLOAD
	require __DIR__ . "/../vendor/autoload.php";
	
	$s_date = date("Y-m-d\TH:i:s+09:00", mktime(date("H"), date("i"), date("s"), date("m"), date("d") - 1, date("Y"))); // 하루 전
	$e_date = date("Y-m-d\TH:i:s+09:00", mktime(date("H"), date("i"), date("s") - 1, date("m"), date("d"), date("Y"))); // 1초 전
	
	// GET DATA
	use InfluxDB2\Client;
	use InfluxDB2\WriteType as WriteType;
	
	$client = new Client([
	    "url" => "https://us-west-2-1.aws.cloud2.influxdata.com",
	    "token" => INFLUXDATA_TOKEN,
	]);
	
	$measurement = "ga2";
	$host = "hemochart";
	
	$query = 'from(bucket: "' . "datafirst" . '")';
	$query .= '  |> range(start: ' . $s_date . ', stop: ' . $e_date . ')';
	$query .= '  |> filter(fn: (r) => r["_measurement"] == "' . $measurement . '")';
	$query .= '  |> filter(fn: (r) => r["host"] == "' . $host . '")';
	$query .= '  |> filter(fn: (r) => r["_field"] == "active30")';
	$query .= '  |> aggregateWindow(every: 5m, fn: mean, createEmpty: true)';
	$query .= '  |> yield(name: "mean")';
	
	$tables = $client->createQueryApi()->query($query, "bori0211@gmail.com");
	
	if (is_array($tables[0]->records)) echo "1";
	var_dump($tables);
?>