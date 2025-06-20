<?
	// REQUIRE FILES (필수)
	require "../config.inc.php";
	require "../set_init_data.inc.php";
	require "../function.inc.php";
	
	header("Content-Type: application/json; charset=utf-8");
	
	// MYSQLi INSTANCE
	$mysqli = mysqli_instance();
	
	
	$toTimeZone = 540;
	
			// 24시간
			for ($i = 0; $i <= 11; $i++) {
				$currentAnnotation = "";
				
				for ($j = -1; $j <= 0; $j++) {
					$year = date("Y");
					$month = date("m");
					$day = date("d");
	
	
					$start = date("Y-m-d", mktime(($i * 2), 0, 0, $month, $day + $j, $year));
					$end = date("YmdHi", mktime(($i * 2) + 2, 0, 0, $month, $day + $j, $year));
					
					echo $end . "\n";
				}
			}
	
	
	
			// 31일
			for ($i = 1; $i <= 31; $i++) {
				for ($j = -1; $j <= 0; $j++) {
					$day = $i;
					
					//$start = date("Y-m-d\TH:i:s\Z", mktime(0, (0 - $toTimeZone), 0, date("m") + $j, $day, date("Y")));
					//$end = date("Y-m-d\TH:i:s\Z", mktime(0, (0 - $toTimeZone), 0, date("m") + $j, $day + 1, date("Y")));
					
					$start = date("Y-m-d", mktime(0, 0, 0, date("m") + $j, $day, date("Y")));
					$end = date("Y-m-d", mktime(0, 0, 0, date("m") + $j, $day + 1, date("Y")));
					
					$query = "SELECT MAX(playerCount) FROM concurrentPlayers";
					$query .= " WHERE DATE_FORMAT(DATE_ADD(fetchedAt, INTERVAL " . $toTimeZone . " MINUTE), '%Y-%m-%d') BETWEEN '" . $start . "' AND '" . $end . "'";
					
					echo $query . "\n";
					
					/*
					if ($j == -1) {
						list($prevCount) = $mysqli->query_fetch_first_row($query);
					}
					
					if ($j == 0) {
						$label = strftime("%d", mktime(0, 0, 0, date("m") + $j, $day, date("Y")));
						list($currentCount) = $mysqli->query_fetch_first_row($query);
						$currentAnnotation = getSuffix($currentCount);
					}
					*/
				}
			}
	
	
	
			// 31일
			for ($i = 1; $i <= 31; $i++) {
				for ($j = -1; $j <= 0; $j++) {
					$day = $i;
					
					/*
					$start = date("Y-m-d\TH:i:s\Z", mktime(0, (0 - $toTimeZone), 0, date("m") + $j, $day, date("Y")));
					$end = date("Y-m-d\TH:i:s\Z", mktime(0, (0 - $toTimeZone), 0, date("m") + $j, $day + 1, date("Y")));
					
					$query = "SELECT MAX(playerCount) FROM concurrentPlayers";
					$query .= " WHERE fetchedAt BETWEEN '" . $start . "' AND '" . $end . "'";
					
					if ($j == -1) {
						list($prevCount) = $mysqli->query_fetch_first_row($query);
					}
					
					if ($j == 0) {
						$label = strftime("%d", mktime(0, 0, 0, date("m") + $j, $day, date("Y")));
						list($currentCount) = $mysqli->query_fetch_first_row($query);
						$currentAnnotation = getSuffix($currentCount);
					}
					*/
					
					if ($j == 0) {
						$label = strftime("%d", mktime(0, 0, 0, date("m") + $j, $day, date("Y")));
						echo $label . "\n";
					}
				}
				
				$labels[] = $label;
				
				$data["prev"][$label] = $prevCount;
				$data["current"][$label] = $currentCount;
				$data["currentAnnotation"][$label] = $currentAnnotation;
			}
	
	
	
	//$start = date("Y-m-d\TH:i:s\Z", mktime(0, (0 - $toTimeZone), 0, date("m"), $day, date("Y")));
	//$start = date("w", mktime(0, 0, 0, date("m"), $day, date("Y")));
	
	//echo $start;
	
	/*
	$currentWeek = date("w", mktime(0, 0, 0, date("m"), date("d"), date("Y")));
	$weeks = [0, 1, 2, 3, 4, 5, 6];
	foreach ($weeks as $week) {
		
		
		$day = date("d") - $currentWeek + $week;
		//$day = date("d");
		
		$start = date("Y-m-d", mktime(0, 0, 0, date("m"), $day, date("Y")));
		$week = strftime("%a", mktime(0, 0, 0, date("m"), $day, date("Y")));
		
		echo $week . ":" . $start . "\n";
	}
	*/
	
	
	/*
	unset($labels);
	unset($data);
	
	
	$toTimeZone = 540;
	
	// 24시간
	for ($i = 0; $i <= 11; $i++) {
		$prevAnnotation = "";
		$currentAnnotation = "";
		
		$data["prev"][$label] = $prevCount;
		$data["current"][$label] = $currentCount;
	}
	*/
	
	
	
	// MYSQLi CLOSE
	$mysqli->close();
?>