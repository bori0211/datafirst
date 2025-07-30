#!/usr/bin/php
<?
	// ONLY CLI
	if (php_sapi_name() != "cli") exit("Command line Only.");
	
	// FUNCTION INCLUDE
	require __DIR__ . "/../config.inc.php";
	require __DIR__ . "/../function.inc.php";
	
	// MYSQLi INSTANCE
	$mysqli = mysqli_instance();
	
	
	
	// 구글 API
	$client = new Google_Client();
	$client->setApplicationName("Client_Library_Examples");
	$client->setDeveloperKey(YOUTUBE_DEVELOPER_KEY_KEY);
	
	$service = new Google_Service_Books($client);
	$optParams = array('filter' => 'free-ebooks');
	$results = $service->volumes->listVolumes('Henry David Thoreau', $optParams);
	
	foreach ($results as $item) {
		echo $item['volumeInfo']['title'], "\n";
	}
	
	
	
	// MYSQLi CLOSE
	$mysqli->close();
?>