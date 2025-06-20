<?
	// REQUIRE FILES (필수)
	require "../config.inc.php";
	require "../set_init_data.inc.php";
	require "../function.inc.php";
	
	header("Content-Type: application/json; charset=utf-8");
	
	// MYSQLi INSTANCE
	$mysqli = mysqli_instance();
	
	
	
	
	$period = "month:2019-02";
	$toTimeZone = 540;
	
	list($selected_period, $selected_month) = explode(":", $period);
	list($selected_month_Y, $selected_month_m) = explode("-", $selected_month);
	
	echo $selected_month_Y . "<br>";
	echo $selected_month_m . "<br>";
	
	
		// 31일
		for ($i = 1; $i <= 31; $i++) {
			$label = $i;
			
			for ($j = -1; $j <= 0; $j++) {
				$day = $i;
				
				// 30일까지만 있다면 SKIP
				$last_day = date("t", mktime(0, 0, 0, $selected_month_m + $j, 1, $selected_month_Y));
				
				$start = date("Y-m-d\TH:i:s\Z", mktime(0, (0 - $toTimeZone), 0, $selected_month_m + $j, $day, $selected_month_Y));
				$end = date("Y-m-d\TH:i:s\Z", mktime(0, (0 - $toTimeZone), 0, $selected_month_m + $j, $day + 1, $selected_month_Y));
				
				$query = "SELECT MAX(concurrentPlayers) FROM timelineSteam";
				$query .= " WHERE fetchedAt >= '" . $start . "' ";
				$query .= " AND fetchedAt < '" . $end . "'";
				
				if ($j == -1) {
					list($prevCount) = $mysqli->query_fetch_first_row($query);
					
					if ($i > $last_day) $prevCount = 0;
				}
				
				if ($j == 0) {
					//$label = strftime("%e", mktime(0, 0, 0, date("m") + $j, $day, date("Y")));
					//$label = $i;
					list($currentCount) = $mysqli->query_fetch_first_row($query);
					if (date("Y") == $selected_month_Y && date("m") == $selected_month_m && date("j") == $day) $currentCount = 0;
					
					if ($i > $last_day) $currentCount = 0;
					
					$currentAnnotation = getSuffix($currentCount);
				}
			}
			
			$labels[] = $label;
			
			$data["prev"][$label] = $prevCount;
			$data["current"][$label] = $currentCount;
			$data["currentAnnotation"][$label] = $currentAnnotation;
		}
		
		var_dump($data);
	
	
	
	
	/*
	// 30일
	for ($i = 1; $i <= 31; $i++) {
		for ($j = -1; $j <= 0; $j++) {
			$day = $i;
			
			
			
			// 30일까지만 있다면 SKIP
			$last_day = date("t", mktime(0, (0 - $toTimeZone), 0, $selected_month_m + $j, 1, $selected_month_Y));
			
			//echo $last_day . " <br>";
			
			
			$start = date("Y-m-d", mktime(0, (0 - $toTimeZone), 0, $selected_month_m + $j, $day, $selected_month_Y));
			$end = date("Y-m-d", mktime(0, (0 - $toTimeZone), 0, $selected_month_m + $j, $day + 1, $selected_month_Y));
			
			//$last_day = date("t", strtotime($selected_month . "-01"));
			//echo "last:" . $last_day . "<br>";
			
			//echo $i . "/" . $last_day . " - " . $start . ":" . $end . "<br>";
			
			if ($j == -1) {
				//list($prevCount) = $mysqli->query_fetch_first_row($query);
				//echo $start . " ~ " . $end . "<br>";
				
				if ($i > $last_day) continue;
				
				echo "prev:" .  $start . " ~ " . $end . "<br>";
				
			}
			
			if ($j == 0) {
				if ($i > $last_day) continue;
				
				echo "current:" .  $start . " ~ " . $end . "<br>";
			}
		}
		
		$labels[] = $label;
		
		$data["prev"][$label] = $prevCount;
		$data["current"][$label] = $currentCount;
		$data["currentAnnotation"][$label] = $currentAnnotation;
	}
	*/
	
	
	
	
	
	// MYSQLi CLOSE
	$mysqli->close();
?>
