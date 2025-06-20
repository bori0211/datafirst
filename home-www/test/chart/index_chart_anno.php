<?
	// REQUIRE FILES (필수)
	require "../config.inc.php";
	require "../set_init_data.inc.php";
	require "../function.inc.php";
	
	header("Content-Type: application/json; charset=utf-8");
	
	// MYSQLi INSTANCE
	$mysqli = mysqli_instance();
	
	
	
	unset($labels);
	unset($data);
	
	
	$toTimeZone = 540;
	
	// 24시간
	for ($i = 0; $i <= 11; $i++) {
		$prevAnnotation = "";
		$currentAnnotation = "";
		
		for ($j = -1; $j <= 0; $j++) {
			$year = date("Y");
			$month = date("m");
			$day = date("d");
			
			$start = date("Y-m-d\TH:i:s\Z", mktime(($i * 2), (0 - $toTimeZone), 0, $month, $day + $j, $year));
			$end = date("Y-m-d\TH:i:s\Z", mktime(($i * 2) + 2, (0 - $toTimeZone), 0, $month, $day + $j, $year));
			
			$query = "SELECT ROUND(AVG(playerCount)) FROM concurrentPlayers";
			$query .= " WHERE fetchedAt BETWEEN '" . $start . "' AND '" . $end . "'";
			
			//echo $query;
			
			if ($j == -1) {
				list($prevCount) = $mysqli->query_fetch_first_row($query);
				
			}
			
			if ($j == 0) {
				$label = $i * 2 . ":00";
				list($currentCount) = $mysqli->query_fetch_first_row($query);
			}
		}
		
		$labels[] = $label;
		//array_push($labels, $label);
		
		
		$data["prev"][$label] = $prevCount;
		$data["current"][$label] = $currentCount;
	}
	
	/*
	$data["prev"]["00"] = 50;
	$data["prev"]["02"] = 150;
	$data["current"]["00"] = 250;
	$data["current"]["02"] = 350;
	*/
	
	//var_dump($labels);
	
	
	
	//echo "Deviation:" . standDeviation(array_filter($data["current"])) . "\n";
	echo "Deviation:" . standDeviation(array_filter(array(4, 5, 8))) . "\n";
	echo "max:" . max(array_filter($data["current"])) . "\n";
	echo "min:" . min(array_filter($data["current"])) . "\n";
	
	echo "count:" . count($labels) . "\n";
	
	foreach ($labels as $k => $label) {
		$this_lable = $label;
		$next_lable = $labels[$k + 1];
		
		$isAnnotation = false;
		
		if ($k == 0 || $k == count($labels) - 1) $isAnnotation = true;
		if ($data["current"][$this_lable] == min(array_filter($data["current"]))) $isAnnotation = true;
		if ($data["current"][$this_lable] == max(array_filter($data["current"]))) $isAnnotation = true;
		if ($data["current"][$next_lable] == "") $isAnnotation = true;
		
		
		$data["isAnnotation"][$this_lable] = $isAnnotation;
		
		
		echo "(" . $k . "):" . $label . " : val:" . $data["current"][$this_lable] . " : next:" . $data["current"][$next_lable] . "\n";
	}
	
	var_dump($data);
	
	
	
	// MYSQLi CLOSE
	$mysqli->close();
?>