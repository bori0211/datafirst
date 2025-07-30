<?
	// REQUIRE FILES (필수)
	require "../config.inc.php";
	require "../set_init_data.inc.php";
	require "../function.inc.php";
	
	header("Content-Type: application/json; charset=utf-8");
	
	// MYSQLi INSTANCE
	$mysqli = mysqli_instance();
	
	
	
	// currentPlayers
	if ($act == "currentPlayers") {
		echo '{';
		echo '  "cols": [';
		echo '    {"id": "", "label": "Mode", "pattern": "", "type": "string"},';
		echo '    {"id": "", "label": "Current", "pattern": "", "type": "number"},';
		echo '    {"type": "string", "p": {"role": "style"}},';
		echo '    {"type": "string", "role": "tooltip", "p": {"html": true}},';
		echo '    {"id": "","label": "Prev", "pattern": "", "type": "number"},';
		echo '    {"type": "string", "p": {"role": "style"}},';
		echo '    {"type": "string", "p": {"role": "tooltip"}}';
		echo '  ],';
		echo '  "rows": [';
		
		// 30일
		for ($i = 0; $i <= 23; $i++) {
			for ($j = 0; $j <= 1; $j++) {
				$day = $i;
				
				$start = date("Y-m-d\TH:i:s\Z", mktime(0, 0, 0, "1", $day, date("Y") + $j));
				$end = date("Y-m-d\TH:i:s\Z", mktime(0, 0, 0, "1", $day + 1, date("Y") + $j));
				
				$query = "SELECT IFNULL(MAX(concurrentPlayers), 0) FROM timelineSteam";
				$query .= " WHERE fetchedAt >= '" . $start . "' ";
				$query .= " AND fetchedAt < '" . $end . "'";
				
				//echo $query;
				
				if ($j == 0) list($prevCount) = $mysqli->query_fetch_first_row($query);
				if ($j == 1) list($currentCount) = $mysqli->query_fetch_first_row($query);
			}
			
			//$prevCount = 0;
			//$currentCount = 0;
			
			
			if ($i > 0) echo ', ';
			
			$color = "red";
			
			echo '    {"c": [';
			echo '      {"v": "' . $i . '", "f": null},';
			echo '      {"v": ' . $prevCount . ', "f": null},';
			echo '      {"v": "opacity: 1; stroke-opacity: 1; stroke-width: 2; color: #3e67cf"},';
			echo '      {"v": "1 <b>AVG</b> ' . $prevCount . '", "f": null},';
			echo '      {"v": ' . $currentCount . ', "f": null},';
			echo '      {"v": "opacity: 1; stroke-opacity: 1; stroke-width: 2; color: red"},';
			echo '      {"v": "2 AVG ' . $currentCount . '", "f": null}';
			echo '    ]}';
		}
		
		
		echo '  ],';
		echo '  "title": "title Mode"';
		echo '}';
	}
	
	
	
	// MYSQLi CLOSE
	$mysqli->close();
?>