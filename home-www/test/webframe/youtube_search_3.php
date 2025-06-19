<?
	// REQUIRE FILES (필수)
	require "../config.inc.php";
	require "../set_init_data.inc.php";
	require "../function.inc.php";
	
	// MYSQLi INSTANCE
	$mysqli = mysqli_instance();
	
	
$youtube = new Madcoda\Youtube\Youtube(array('key' => 'AIzaSyDfVfbbvDpw-IklU7ED9EOXvZUh7NwUAeM'));
$video = $youtube->getVideoInfo('rie-hPVJ7Sw');	

var_dump($video);
	
	
	// MYSQLi CLOSE
	$mysqli->close();
?>
