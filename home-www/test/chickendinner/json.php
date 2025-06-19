<?
	$deaths = json_decode('{"byplayer":"92","logout":"1","suicide":"1"}', true);
	
	//for ($num = 0; $row = $res->fetch_row(); $num++) {
	//}
	
	foreach ($deaths as $key => $value) {
		if (array_key_first($deaths) != $key) echo ', ';
		
		//echo 
		
		var_dump($key);
		//var_dump($value);
	}
	
	
	var_dump($deaths);
?>
