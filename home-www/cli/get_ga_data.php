#!/usr/bin/php
<?
	// ONLY CLI
	if (php_sapi_name() != "cli") exit("Command line Only.");
	
	// REQUIRE FILES (필수)
	require __DIR__ . "/../config.inc.php";
	require __DIR__ . "/../function.inc.php";
	
	$cli_start_time = getmicrotime();
	
	echo "Start: " . date("Y-m-d H:i:s") . "\n\n";
	
	
	
	////////////////////////////////////////////////////////////////
	// GA Sample                                                  //
	// https://github.com/googleanalytics/php-docs-samples        //
	////////////////////////////////////////////////////////////////
	
	echo "\n";
	echo "[Google analytics Jobs]\n";
	
	//Load Composer's autoloader
	require __DIR__ . "/../vendor/autoload.php";
	
	// Google GA
	putenv("GOOGLE_APPLICATION_CREDENTIALS=" . __DIR__ . '/../google_keys.json');
	
	
	
/**
 * TODO(developer): Replace this variable with your Google Analytics 4
 *   property ID before running the sample.
 */
$property_id = '307755691';


run_realtime_report_with_minute_ranges($property_id);

use Google\Analytics\Data\V1beta\Client\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\MetricType;
use Google\Analytics\Data\V1beta\MinuteRange;
use Google\Analytics\Data\V1beta\RunRealtimeReportRequest;
use Google\Analytics\Data\V1beta\RunRealtimeReportResponse;

/**
 * Runs a realtime report on a Google Analytics 4 property. Dimensions field is
 * omitted in the query, which results in total values of active users returned
 * for each minute range in the report.
 *
 * Note the `dateRange` dimension added to the report response automatically as
 * a result of querying multiple minute ranges.
 * @param string $propertyId Your GA-4 Property ID
 */
function run_realtime_report_with_minute_ranges(string $propertyId)
{
    // Create an instance of the Google Analytics Data API client library.
    $client = new BetaAnalyticsDataClient();

    // Make an API call.
    $request = (new RunRealtimeReportRequest())
        ->setProperty('properties/' . $propertyId)
        ->setMetrics([
            new Metric(['name' => 'activeUsers']),
        ])
        ->setMinuteRanges([
            new MinuteRange(['name' => '1-2 minutes ago', 'start_minutes_ago' => 1, 'end_minutes_ago' => 1]),
            new MinuteRange(['name' => '0-29 minutes ago', 'start_minutes_ago' => 29, 'end_minutes_ago' => 0]),
        ]);
    $response = $client->runRealtimeReport($request);
	
	var_dump($response);
	
	//var_dump($response->rows[0]);
	
	foreach ($response->getRows() as $row) {
		var_dump($row->getMetricValues()[0]->getValue());
	}
		
	
	//var_dump($response->rows[1]->metricValues[0]);

    //printRunRealtimeReportWithMinuteRangesResponse($response);
}

/**
 * Print results of a runRealtimeReport call.
 * @param RunRealtimeReportResponse $response
 */
function printRunRealtimeReportWithMinuteRangesResponse(RunRealtimeReportResponse $response)
{
    printf('%s rows received%s', $response->getRowCount(), PHP_EOL);
    foreach ($response->getDimensionHeaders() as $dimensionHeader) {
        printf('Dimension header name: %s%s', $dimensionHeader->getName(), PHP_EOL);
    }
    foreach ($response->getMetricHeaders() as $metricHeader) {
        printf(
            'Metric header name: %s (%s)%s',
            $metricHeader->getName(),
            MetricType::name($metricHeader->getType()),
            PHP_EOL
        );
    }

    print 'Report result: ' . PHP_EOL;
    foreach ($response->getRows() as $row) {
        printf(
            '%s %s' . PHP_EOL,
            $row->getDimensionValues()[0]->getValue(),
            $row->getMetricValues()[0]->getValue()
        );
    }
}	

	
	
	
	
	
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