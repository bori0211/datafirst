<?
	// REQUIRE FILES (필수)
	require "../config.inc.php";
	require "../set_init_data.inc.php";
	require "../function.inc.php";
	
	header("Content-Type: application/json; charset=utf-8");
	
	// MYSQLi INSTANCE
	$mysqli = mysqli_instance();
	
	
	
	// seasonMode
	if ($act == "seasonMode") {
		echo '{';
		echo '  "cols": [';
		echo '    {"id": "", "label": "Mode", "pattern": "", "type": "string"},';
		echo '    {"id": "", "label": "Matches", "pattern": "", "type": "number"},';
		echo '    {"type": "string", "p": {"role": "style"}},';
		echo '    {"type": "string", "p": {"role": "tooltip"}},';
		echo '    {"id": "", "label": "MatchesMax", "pattern": "", "type": "number"},';
		echo '    {"type": "string", "p": {"role": "style"}},';
		echo '    {"type": "string", "p": {"role": "tooltip"}},';
		echo '    {"id": "", "label": "3333", "pattern": "", "type": "number"},';
		echo '    {"id": "", "label": "4444", "pattern": "", "type": "number"},';
		echo '    {"id": "", "label": "5555", "pattern": "", "type": "number"},';
		echo '    {"id": "", "label": "666", "pattern": "", "type": "number"}';
		echo '  ],';
		echo '  "rows": [';
		
		list($currentSeasonId, $currentSeasonName) = $mysqli->query_fetch_first_row("SELECT seasonId, seasonName FROM season WHERE isCurrentSeason");
		
		$soloRoundsPlayed = 0;
		$duoRoundsPlayed = 0;
		$squadRoundsPlayed = 0;
		$soloFppRoundsPlayed = 0;
		$duoFppRoundsPlayed = 0;
		$squadFppRoundsPlayed = 0;
		
		if ($gameMode == "" || $gameMode == "solo") list($soloRoundsPlayed) = $mysqli->query_fetch_first_row("SELECT roundsPlayed FROM playerSeasonsStats WHERE shardId = '" . $shardId . "' AND playerId = '" . $playerId . "' AND seasonId = '" . $currentSeasonId . "' AND gameMode = 'solo'");
		if ($gameMode == "" || $gameMode == "duo") list($duoRoundsPlayed) = $mysqli->query_fetch_first_row("SELECT roundsPlayed FROM playerSeasonsStats WHERE shardId = '" . $shardId . "' AND playerId = '" . $playerId . "' AND seasonId = '" . $currentSeasonId . "' AND gameMode = 'duo'");
		if ($gameMode == "" || $gameMode == "squad") list($squadRoundsPlayed) = $mysqli->query_fetch_first_row("SELECT roundsPlayed FROM playerSeasonsStats WHERE shardId = '" . $shardId . "' AND playerId = '" . $playerId . "' AND seasonId = '" . $currentSeasonId . "' AND gameMode = 'squad'");
		if ($gameMode == "" || $gameMode == "solo-fpp") list($soloFppRoundsPlayed) = $mysqli->query_fetch_first_row("SELECT roundsPlayed FROM playerSeasonsStats WHERE shardId = '" . $shardId . "' AND playerId = '" . $playerId . "' AND seasonId = '" . $currentSeasonId . "' AND gameMode = 'solo-fpp'");
		if ($gameMode == "" || $gameMode == "duo-fpp") list($duoFppRoundsPlayed) = $mysqli->query_fetch_first_row("SELECT roundsPlayed FROM playerSeasonsStats WHERE shardId = '" . $shardId . "' AND playerId = '" . $playerId . "' AND seasonId = '" . $currentSeasonId . "' AND gameMode = 'duo-fpp'");
		if ($gameMode == "" || $gameMode == "squad-fpp") list($squadFppRoundsPlayed) = $mysqli->query_fetch_first_row("SELECT roundsPlayed FROM playerSeasonsStats WHERE shardId = '" . $shardId . "' AND playerId = '" . $playerId . "' AND seasonId = '" . $currentSeasonId . "' AND gameMode = 'squad-fpp'");
		
		echo '    {"c": [{"v": "solo", "f": null}, {"v": ' . $soloRoundsPlayed . ', "f": null}, {"v": "stroke-width:0; color: red"}, {"v": "tooltip:10", "f": null}, {"v": 100, "f": null}, {"v": "stroke-width: 0.1; color: grey"}, {"v": "tooltip:110", "f": null}]},';
		echo '    {"c": [{"v": "duo", "f": null}, {"v": ' . $duoRoundsPlayed . ', "f": null}, {"v": "stroke-width:0; color: red"}, {"v": "tooltip:20", "f": null}, {"v": 100, "f": null}, {"v": "stroke-width: 0.1; color: grey"}, {"v": "tooltip:120", "f": null}]},';
		echo '    {"c": [{"v": "squad", "f": null}, {"v": ' . $squadRoundsPlayed . ', "f": null}, {"v": "stroke-width:0; color: red"}, {"v": "tooltip:30", "f": null}, {"v": 100, "f": null}, {"v": "stroke-width: 0; color: grey"}, {"v": "tooltip:130", "f": null}]},';
		echo '    {"c": [{"v": "solo-fpp", "f": null}, {"v": ' . $soloFppRoundsPlayed . ', "f": null}, {"v": "stroke-width:0; color: red"}, {"v": "tooltip:40", "f": null}, {"v": 100, "f": null}, {"v": "stroke-width: 0; color: grey"}, {"v": "tooltip:140", "f": null}]},';
		echo '    {"c": [{"v": "duo-fpp", "f": null}, {"v": ' . $duoFppRoundsPlayed . ', "f": null}, {"v": "stroke-width:0; color: blue"}, {"v": "tooltip:50", "f": null}, {"v": 100, "f": null}, {"v": "stroke-width: 0; color: grey"}, {"v": "tooltip:150", "f": null}]},';
		echo '    {"c": [{"v": "squad-fpp", "f": null}, {"v": ' . $squadFppRoundsPlayed . ', "f": null}, {"v": "stroke-width:0; color: green"}, {"v": "tooltip:60", "f": null}, {"v": 100, "f": null}, {"v": "stroke-width: 0; color: grey"}, {"v": "tooltip:160", "f": null}]}';
		
		echo '  ],';
		echo '  "title": "' . $currentSeasonName . ' Mode"';
		echo '}';
	}
	
	// seasonWins
	if ($act == "seasonWins") {
		echo '{';
		echo '  "cols": [';
		echo '    {"id": "", "label": "Wins", "pattern": "", "type": "string"},';
		echo '    {"id": "", "label": "Matches", "pattern": "", "type": "number"}';
		echo '  ],';
		echo '  "rows": [';
		
		list($currentSeasonId, $currentSeasonName) = $mysqli->query_fetch_first_row("SELECT seasonId, seasonName FROM season WHERE isCurrentSeason");
		
		$query = "SELECT";
		$query .= " IFNULL(SUM(roundsPlayed), 0),";
		$query .= " IFNULL(SUM(wins), 0),";
		$query .= " IFNULL(SUM(top10s), 0)";
		$query .= " FROM playerSeasonsStats";
		$query .= " WHERE shardId = '" . $shardId . "' AND playerId = '" . $playerId . "' AND seasonId = '" . $currentSeasonId . "'";
		if ($gameMode != "")
			$query .= " AND gameMode = '" . $gameMode . "'";
		
		$res = $mysqli->query($query) or exit($mysqli->error);
		
		if ($row = $res->fetch_row()) {
			$roundsPlayed = $row[0];
			$wins = $row[1];
			$top10s = $row[2];
			
			$top10s -= $wins;
			$top10over = $roundsPlayed;
			$top10over -= $wins;
			$top10over -= $top10s;
			
			echo '    {"c": [{"v": "Wins", "f": null}, {"v": ' . $wins . ', "f": null}]},';
			echo '    {"c": [{"v": "Top10s", "f": null}, {"v": ' . $top10s . ', "f": null}]},';
			echo '    {"c": [{"v": "Top10over", "f": null}, {"v": ' . $top10over . ', "f": null}]}';
		}
		
		echo '  ],';
		echo '  "slices": [{"color": "#3e67cf"}, {"color": "#8ba3e0"}, {"color": "#d7dfef"}],';
		echo '  "title": "' . $currentSeasonName . ' Wins"';
		echo '}';
	}
	
	// seasonKD
	if ($act == "seasonKD") {
		echo '{';
		echo '  "cols": [';
		echo '    {"id": "", "label": "Kills", "pattern": "", "type": "string"},';
		echo '    {"id": "", "label": "Count", "pattern": "", "type": "number"}';
		echo '  ],';
		echo '  "rows": [';
		
		list($currentSeasonId, $currentSeasonName) = $mysqli->query_fetch_first_row("SELECT seasonId, seasonName FROM season WHERE isCurrentSeason");
		
		$query = "SELECT";
		$query .= " IFNULL(SUM(kills), 0),";
		$query .= " IFNULL(SUM(losses), 0)";
		$query .= " FROM playerSeasonsStats";
		$query .= " WHERE shardId = '" . $shardId . "' AND playerId = '" . $playerId . "' AND seasonId = '" . $currentSeasonId . "'";
		if ($gameMode != "")
			$query .= " AND gameMode = '" . $gameMode . "'";
		
		$res = $mysqli->query($query) or exit($mysqli->error);
		
		if ($row = $res->fetch_row()) {
			$kills = $row[0];
			$losses = $row[1];
			
			if ($losses != 0)
				$kdRatio = number_format($kills / $losses, 1);
			else
				$kdRatio = number_format(0, 1);
			
			$title = $currentSeasonName . " K/D (" . $kdRatio . ")";
			
			echo '    {"c": [{"v": "Kills", "f": null}, {"v": ' . $kills . ', "f": null}]},';
			echo '    {"c": [{"v": "Deaths", "f": null}, {"v": ' . $losses . ', "f": null}]}';
		}
		
		echo '  ],';
		echo '  "slices": [{"color": "#dc3912"}, {"color": "#ccc"}],';
		echo '  "title": "' . $title . '"';
		echo '}';
	}
	
	
	
	// rp (rank points)
	if ($act == "rpSolo" || $act == "rpDuo" || $act == "rpSquad" || $act == "rpSoloFpp" || $act == "rpDuoFpp" || $act == "rpSquadFpp") {
		echo '{';
		echo '  "cols": [';
		echo '    {"id": "", "label": "RP", "pattern": "", "type": "string"},';
		echo '    {"id": "", "label": "RP", "pattern": "", "type": "number"},';
		echo '    {"id": "", "label": "RP", "pattern": "", "type": "number"},';
		echo '    {"id": "", "label": "RP", "pattern": "", "type": "number"},';
		echo '    {"id": "", "label": "RP", "pattern": "", "type": "number"},';
		echo '    {"type": "string", "p": {"role": "style"}},';
		echo '    {"type": "string", "p": {"role": "tooltip"}}';
		echo '  ],';
		
		echo '  "rows": [';
		
		// 최근 7일
		for ($i = 0; $i <= 7; $i++) {
			if ($toTimeZone == "") $toTimeZone = 0;
			
			$selectedDate = new \Moment\Moment();
			$selectedDate->addDays($i - 7);
			$selectedDate->addMinutes($toTimeZone);
			
			$query = "SELECT";
			$query .= " COUNT(*),";
			$query .= " IFNULL(MIN(rankPoints), 0),";
			$query .= " IFNULL(MAX(rankPoints), 0)";
			$query .= " FROM playerMatchesStats";
			$query .= " WHERE shardId = '" . $shardId . "' AND playerId = '" . $playerId . "' AND rankPoints > 0 AND mapName IN ('Erangel_Main', 'Desert_Main', 'Savage_Main')";
			if ($act == "rpSolo")
				$query .= " AND gameMode IN ('solo') AND isCustomMatch = 0";
			else if ($act == "rpDuo")
				$query .= " AND gameMode IN ('duo') AND isCustomMatch = 0";
			else if ($act == "rpSquad")
				$query .= " AND gameMode IN ('squad') AND isCustomMatch = 0";
			else if ($act == "rpSoloFpp")
				$query .= " AND gameMode IN ('solo-fpp') AND isCustomMatch = 0";
			else if ($act == "rpDuoFpp")
				$query .= " AND gameMode IN ('duo-fpp') AND isCustomMatch = 0";
			else if ($act == "rpSquadFpp")
				$query .= " AND gameMode IN ('squad-fpp') AND isCustomMatch = 0";
			$query .= " AND DATE_FORMAT(DATE_ADD(finishedAt, INTERVAL " . $toTimeZone . " MINUTE), '%Y-%m-%d') = '" . $selectedDate->format("Y-m-d") . "'";
			
			list($matchesCount, $minRP, $maxRP) = $mysqli->query_fetch_first_row($query);
			
			$minRPBar = $minRP - 2;
			$maxRPBar = $maxRP + 2;
			
			if ($act == "rpSolo")
				$title = "solo rank points";
			else if ($act == "rpDuo")
				$title = "duo rank points";
			else if ($act == "rpSquad")
				$title = "squad rank points";
			else if ($act == "rpSoloFpp")
				$title = "solo-fpp rank points";
			else if ($act == "rpDuoFpp")
				$title = "duo-fpp rank points";
			else if ($act == "rpSquadFpp")
				$title = "squad-fpp rank points";
			
			if ($act == "rpSolo" || $act == "rpSoloFpp")
				$color = "#00a65a";
			else if ($act == "rpDuo" || $act == "rpDuoFpp")
				$color = "#dd4b39";
			else if ($act == "rpSquad" || $act == "rpSquadFpp")
				$color = "#f39c12";
			
			if ($i > 0) echo ', ';
			
			echo '    {"c": [';
			echo '      {"v": "' . $selectedDate->format("d") . '", "f": null},';
			echo '      {"v": ' . $minRPBar . ', "f": null},';
			echo '      {"v": ' . $minRP . ', "f": null},';
			echo '      {"v": ' . $maxRP . ', "f": null},';
			echo '      {"v": ' . $maxRPBar . ', "f": null},';
			echo '      {"v": "opacity: 1; stroke-opacity: 1; stroke-width: 0.1; color: ' . $color . '"},';
			echo '      {"v": "' . $selectedDate->format("Y-m-d") . ' ( ' . $matchesCount . ' Matches / ' . $minRP . ' - ' . $maxRP . ' )", "f": null}';
			echo '    ]}';
		}
		
		echo '  ],';
		echo '  "title": "' . $title . '"';
		echo '}';
	}
	
	
	
	// MYSQLi CLOSE
	$mysqli->close();
?>