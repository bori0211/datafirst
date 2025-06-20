<?
	// REQUIRE FILES (필수)
	require "../config.inc.php";
	require "../set_init_data.inc.php";
	require "../function.inc.php";
	
	//header("Content-Type:application/json; charset=utf-8");
	
	// MYSQLi INSTANCE
	$mysqli = mysqli_instance();
	
	
	
	// records
	echo '[';
	
	if ($toTimeZone == "") $toTimeZone = 0;
	
	// Season
	$query = "SELECT seasonId, seasonName, isCurrentSeason, DATE_FORMAT(DATE_ADD(start, INTERVAL " . $toTimeZone . " MINUTE), '%Y-%m-%dT%T'), DATE_FORMAT(DATE_ADD(IFNULL(end, CONCAT(UTC_DATE(), 'T', UTC_TIME(), 'Z')), INTERVAL " . $toTimeZone . " MINUTE), '%Y-%m-%dT%T')";
	$query .= " FROM season";
	$query .= " WHERE isCurrentSeason";
	$query .= " ORDER BY seasonName ASC";
	
	$res = $mysqli->query($query) or exit($mysqli->error);
	
	for ($rownum = 0; $row = $res->fetch_row(); $rownum++) {
		$seasonId = $row[0];
		$seasonName = $row[1];
		$isCurrentSeason = $row[2];
		$start = $row[3];
		$end = $row[4];
		
		$end = "2018-09-12T05:08:28Z";
		
		if ($isCurrentSeason) {
			$color = "#3e67cf";
			$textColor = "#fff";
			//$m = new \Moment\Moment();
			//$m->addMinutes($toTimeZone);
			//$end = $m->format();
		} else {
			$color = "rgba(0, 0, 0, 0.3)";
			$textColor = "#fff";
		}
		
		if ($rownum > 0) echo ', ';
		
		echo '{"title":"';
		echo " <span class='d-inline-block text-right' style='width:1.7em'>" . $seasonName . "</span>";
		echo '",';
		echo '"start":"' . $start . '",';
		echo '"end":"' . $end . '",';
		echo '"color":"' . $color . '",';
		echo '"textColor":"' . $textColor . '",';
		echo '"seasonId":"' . $seasonId . '"}';
	}
	
	/*
	// UPDATE
	$query = "SELECT target, DATE_ADD(enforceAt, INTERVAL " . $toTimeZone . " MINUTE), title, noticeUrl";
	$query .= " FROM notices";
	$query .= " WHERE type = 'UPDATE' AND id = 7";
	$query .= " ORDER BY enforceAt ASC";
	
	$res = $mysqli->query($query) or exit($mysqli->error);
	
	for ($rownum = 0; $row = $res->fetch_row(); $rownum++) {
		$target = $row[0];
		$enforceAt = $row[1];
		$title = $row[2];
		$noticeUrl = $row[3];
		
		$color = "rgba(223, 60, 140, 0.3)";
		$textColor = "#666";
		
		
		//$enforceAt = "2018-09-05T00:30:00-04:00";
		$enforceAt = "2018-09-05T09:30";
		
		echo ', ';
		
		echo '{"title":"';
		echo " <span class='d-inline-block text-right' style='width:1.7em'>" . $target . "</span>";
		echo '",';
		echo '"start":"' . $enforceAt . '",';
		//echo '"end":"' . $end . '",';
		echo '"color":"' . $color . '",';
		echo '"textColor":"' . $textColor . '",';
		echo '"seasonId":"' . $seasonId . '"}';
	}
	*/
	
	echo ']';
	
	
	
	// MYSQLi CLOSE
	$mysqli->close();
?>