<?php
	// COMPOSER AUTOLOAD
	require __DIR__ . "/../vendor/autoload.php";
	
	// INFLUXDB2
	define("INFLUXDB2_URL", "https://us-west-2-1.aws.cloud2.influxdata.com");
	define("INFLUXDB2_TOKEN", "HIUIu2nYdXq_g8WT4k-IKJTN2VP_DFykG14oR5FBaArsWfmuKaj70atQy6YAH5GKb8SYLoHoumqnTcRa2skmXw==");
	define("INFLUXDB2_BUCKET", "datafirst");
	define("INFLUXDB2_ORG", "bori0211@gmail.com");
	
	$s_date = date("Y-m-d\TH:i:s+09:00", mktime(date("H"), date("i"), date("s"), date("m"), date("d") - 1, date("Y"))); // 하루 전
	$e_date = date("Y-m-d\TH:i:s+09:00", mktime(date("H"), date("i"), date("s") - 1, date("m"), date("d"), date("Y"))); // 1초 전
	
	// GET DATA
	use InfluxDB2\Client;
	use InfluxDB2\WriteType as WriteType;
	
	$client = new Client([
	    "url" => INFLUXDB2_URL,
	    "token" => INFLUXDB2_TOKEN,
	]);
	
	$measurement = "weather";
	$host = "test1";
	
	$query = 'from(bucket: "' . INFLUXDB2_BUCKET . '")';
	$query .= '  |> range(start: ' . $s_date . ', stop: ' . $e_date . ')';
	$query .= '  |> filter(fn: (r) => r["_measurement"] == "' . $measurement . '")';
	$query .= '  |> filter(fn: (r) => r["host"] == "' . $host . '")';
	$query .= '  |> filter(fn: (r) => r["_field"] == "temp")';
	$query .= '  |> aggregateWindow(every: 5m, fn: mean, createEmpty: true)';
	$query .= '  |> yield(name: "mean")';
	
	$tables = $client->createQueryApi()->query($query, INFLUXDB2_ORG);
	
	if (is_array($tables[0]->records)) echo "1";
	var_dump($tables);
?>