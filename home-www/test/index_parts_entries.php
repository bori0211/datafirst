<?
	// REQUIRE FILES (필수)
	require "../config.inc.php";
	require "../set_init_data.inc.php";
	require "../function.inc.php";
	
	// MYSQLi INSTANCE
	$mysqli = mysqli_instance();
	
	// HEADER INCLUDE
	include "../header.inc.php";
?>


<?
	$usr_route = "artists";
	$clt_route = "Vincent-van-Gogh";
	
	// CURL
	$curl = curl_init();
	
	$url = "https://" . $_SERVER["HTTP_HOST"] . "/parts/entries/collection.php?usr_route=" . $usr_route . "&clt_route=" . $clt_route . "&page=1";
	
	curl_setopt_array($curl, array(
	  CURLOPT_URL => $url,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	));
	
	$response = curl_exec($curl);
	
	curl_close($curl);
	
	
	$response_json = json_decode($response);
	
	//var_dump($response_json->entries);
	
	
	foreach($response_json->entries as $row) {
		var_dump($row->entry);
		//echo $entry->
	}
	
	
?>


<?
	// FOOTER INCLUDE
	include "../footer.inc.php";
	
	// MYSQLi CLOSE
	$mysqli->close();
?>
