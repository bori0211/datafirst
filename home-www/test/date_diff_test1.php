<?
	///$date_today = date_create("now");
	$date_today = new DateTime(date("Y-m-d"));
	$date_member_begin = date_create("2025-05-11");
	$date_member_close = date_create("2025-06-28");
	
	//var_dump($date_today);
	
	$remain_diff = date_diff($date_today, $date_member_close);
	
	//$interval = $date_member_close->diff($date_today);
	
	echo $remain_diff->days;
	
	
	//$remain_diff->days -= 2;
	
	//var_dump($remain_diff);
	
	
	if ($remain_diff->days % 7 == 0) echo "11111111";
	
?>
