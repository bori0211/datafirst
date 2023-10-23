<?php
	$today = date("Y-m-d H:i:s");
	
	
	
	$today = date("Y-m-d\TH:i:s+09:00", mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y")));
	
	
	echo $today;
?>