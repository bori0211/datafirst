#!/usr/bin/php
<?
	// ONLY CLI
	if (php_sapi_name() != "cli") exit("Command line Only.");
	
	// REQUIRE FILES (필수)
	require __DIR__ . "/../config.inc.php";
	require __DIR__ . "/../function.inc.php";
	
	$cli_start_time = getmicrotime();
	
	//echo "Start: " . date("Y-m-d H:i:s") . "\n\n";
	
	
	
	//Load Composer's autoloader
	require __DIR__ . "/../vendor/autoload.php";
	
	// Google GA
	putenv("GOOGLE_APPLICATION_CREDENTIALS=" . __DIR__ . "/../google_keys.json");
	
	$property_id = "307755691";
	
	use Google\Analytics\Data\V1beta\Client\BetaAnalyticsDataClient;
	use Google\Analytics\Data\V1beta\Metric;
	use Google\Analytics\Data\V1beta\MetricType;
	use Google\Analytics\Data\V1beta\MinuteRange;
	use Google\Analytics\Data\V1beta\RunRealtimeReportRequest;
	use Google\Analytics\Data\V1beta\RunRealtimeReportResponse;
	
    // Create an instance of the Google Analytics Data API client library.
    $client = new BetaAnalyticsDataClient();
	
    // Make an API call.
    $request = (new RunRealtimeReportRequest())
        ->setProperty("properties/" . $property_id)
        ->setMetrics([
            new Metric(["name" => "activeUsers"]),
        ])
        ->setMinuteRanges([
            new MinuteRange(["name" => "1 minutes ago", "start_minutes_ago" => 1, "end_minutes_ago" => 1]),
            new MinuteRange(["name" => "30 minutes ago", "start_minutes_ago" => 29, "end_minutes_ago" => 0]),
        ]);
    
    $response = $client->runRealtimeReport($request);
	
	//var_dump($response);
	
	$active1 = 0;
	$active30 = 0;
	
	foreach ($response->getRows() as $row) {
		if ($row->getDimensionValues()[0]->getValue() == "1 minutes ago") $active1 = (int)$row->getMetricValues()[0]->getValue();
		if ($row->getDimensionValues()[0]->getValue() == "30 minutes ago") $active30 = (int)$row->getMetricValues()[0]->getValue();
	}
	
	//var_dump($active1);
	//var_dump($active30);
	
	
	
	// InfluxData
	use InfluxDB2\Client;
	use InfluxDB2\Model\WritePrecision;
	use InfluxDB2\Point;
	
	// Initialize the Client
	$token = INFLUXDATA_TOKEN;
	$org = "27d5bea03ed39a6d";
	$bucket = "datafirst";
	
	$client = new Client([
	    "url" => "https://us-west-2-1.aws.cloud2.influxdata.com",
	    "token" => $token,
	]);
	
	// Write Data
	$writeApi = $client->createWriteApi();
	
	$point = Point::measurement("ga2")
	  ->addTag("host", "hemochart")
	  ->addField("active1", $active1)
	  ->addField("active30", $active30)
	  ->time(microtime(true));
	
	$writeApi->write($point, WritePrecision::S, $bucket, $org);
	
	// Dispose the Client
	$client->close();
	
	
	
	//echo "\n";
	//echo "End: " . date("Y-m-d H:i:s") . " (" . round((getmicrotime() - $cli_start_time) / 60, 2)  . "min)" . "\n";
?>