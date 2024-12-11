<?
	// REQUIRE FILES (필수)
	require __DIR__ . "/../config.inc.php";
	require __DIR__ . "/../set_init_data.inc.php";
	
	//header("Content-Type: application/json; charset=utf-8");
	
	
	putenv("GOOGLE_APPLICATION_CREDENTIALS=" . __DIR__ . '/../google_keys.json');
	
	//var_dump(getenv());
	
	
	



	//Load Composer's autoloader
	require __DIR__ . "/../vendor/autoload.php";



/**
 * TODO(developer): Replace this variable with your Google Analytics 4
 *   property ID before running the sample.
 */
$property_id = '307755691';


run_report_with_multiple_metrics('307755691');

use Google\Analytics\Data\V1beta\Client\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\MetricType;
use Google\Analytics\Data\V1beta\RunReportRequest;
use Google\Analytics\Data\V1beta\RunReportResponse;

/**
 * @param string $propertyID Your GA-4 Property ID
 * Runs a report of active users grouped by three metrics.
 */
function run_report_with_multiple_metrics(string $propertyId)
{
    // Create an instance of the Google Analytics Data API client library.
    $client = new BetaAnalyticsDataClient();

    // Make an API call.
    $request = (new RunReportRequest())
        ->setProperty('properties/' . $propertyId)
        ->setDimensions([new Dimension(['name' => 'date'])])
        ->setMetrics([
            new Metric(['name' => 'activeUsers']),
            new Metric(['name' => 'newUsers']),
            new Metric(['name' => 'totalRevenue'])
        ])
        ->setDateRanges([
            new DateRange([
                'start_date' => '7daysAgo',
                'end_date' => 'today',
            ])
        ]);
    $response = $client->runReport($request);

    printRunReportResponseWithMultipleMetrics($response);
}

/**
 * Print results of a runReport call.
 * @param RunReportResponse $response
 */
function printRunReportResponseWithMultipleMetrics(RunReportResponse $response)
{
    printf('%s rows received%s', $response->getRowCount(), PHP_EOL);
    foreach ($response->getDimensionHeaders() as $dimensionHeader) {
        printf('Dimension header name: %s%s', $dimensionHeader->getName(), PHP_EOL);
    }
    foreach ($response->getMetricHeaders() as $metricHeader) {
        printf(
            'Metric header name: %s (%s)' . PHP_EOL,
            $metricHeader->getName(),
            MetricType::name($metricHeader->getType())
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
	
?>