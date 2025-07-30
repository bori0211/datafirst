<?
	// REQUIRE FILES (필수)
	require __DIR__ . "/../config.inc.php";
	require __DIR__ . "/../set_init_data.inc.php";
	
	//header("Content-Type: application/json; charset=utf-8");
	
	
	//putenv("GOOGLE_APPLICATION_CREDENTIALS=" . __DIR__ . '/Quickstart-e0af7b36e01f.json');
	
	//var_dump(getenv());
	
	
	



	//Load Composer's autoloader
	require __DIR__ . "/../vendor/autoload.php";


use Google\Client;
use Google\Service\AnalyticsReporting;

// 서비스 계정 JSON 키 파일 경로
$KEY_FILE_LOCATION = __DIR__ . '/../google_keys.json';

// Google Analytics 보기 ID
$VIEW_ID = '307755691';

function initializeAnalyticsReporting() {
  $client = new Client();
  $client->useApplicationDefaultCredentials();
  $client->addScope('https://www.googleapis.com/auth/analytics.readonly');

  return new AnalyticsReporting($client);
}

function getReport($analytics) {
  return $analytics->reports()->batchGet(
      body={
          'reportRequests' => [
              [
                  'viewId' => $VIEW_ID,
                  'dateRanges' => [{'startDate': 'today', 'endDate': 'today'}],
                  'metrics' => [{'expression': 'rt:activeUsers'}],
              ]
          ]
      }
  )->execute();
}

// API 초기화
$analytics = initializeAnalyticsReporting();

// 보고서 가져오기
$response = getReport($analytics);

// 응답 데이터 처리
if (isset($response['reports'][0]['data']['rows'])) {
  $row = $response['reports'][0]['data']['rows'][0];
  $activeUsers = $row['metrics'][0]['values'][0];
  echo "현재 활성 사용자 수: " . $activeUsers;
} else {
  echo "데이터를 찾을 수 없습니다.";
}
	
	
?>