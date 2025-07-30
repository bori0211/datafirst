<?
	// REQUIRE FILES (ÇÊ¼ö)
	require "../config.inc.php";
	require "../set_init_data.inc.php";
	require "../function.inc.php";
	
	header("Content-Type: application/json; charset=utf-8");
	

/* activate reporting */
/*
$driver = new mysqli_driver();
//$driver->report_mode = MYSQLI_REPORT_ALL;
echo $driver->client_info;
echo "\n\n";
*/
	
	// MYSQLi INSTANCE
	$mysqli = mysqli_instance();
	
	
	
	$query = "SELECT seasonId, seasonName FROM season";
	//$query .= " WHERE fetchedAt >= '" . $start . "' ";
	//$query .= " AND fetchedAt < '" . $end . "'";
	$query .= " ORDER BY seasonId ASC";
	
	$res = $mysqli->query($query) or exit($mysqli->error);
	
	while ($row = $res->fetch_row()) {
		$seasonId = $row[0];
		$seasonName = $row[1];
		
		echo $seasonId . ":" . $seasonName . "\n";
	}
	
	
	echo "\n";
	
	$query = "SHOW STATUS";
	
	$res = $mysqli->query($query) or exit($mysqli->error);
	
	while ($row = $res->fetch_row()) {
		$Variable_name = $row[0];
		$Value = $row[1];
		
		echo $Variable_name . ":" . $Value . "\n";
	}
	
	
	
	// MYSQLi CLOSE
	$mysqli->close();
?>
