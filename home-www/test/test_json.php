<?
	ob_start();
?>

이것은
시험중
입니다.

<?
	$data = ob_get_contents();
	
	ob_end_clean();
	
	echo $data;
	
	
	$vc_hbs_array = array("comment" => $data);
	$vc_hbs_json = json_encode($vc_hbs_array, JSON_UNESCAPED_UNICODE);
	
	echo "<Br>";
	
	if ($vc_hbs_json == "") $vc_hbs_json = '{"1st": "", "2nd": "", "3rd": "", "4th": ""}';
	$vc_hbs_array = json_decode($vc_hbs_json, true);
	
	echo "<Br>";
	
	
	echo var_dump($vc_hbs_array);
	
	echo "<Br>";
	
?>