<?
	// REQUIRE FILES (필수)
	require "../config.inc.php";
	require "../set_init_data.inc.php";
	require "../function.inc.php";
	
	// MYSQLi INSTANCE
	$mysqli = mysqli_instance();
	
	$selected_menu_id = 411;
	
	$PHP_SELF = "/dialysis/bloodline";
	
	
	
	sleep(2);
	
	// HEADER INCLUDE
	include "../header.inc.php";
?>




<?
	/*$md_hbs_imm = array("md_hbs_imm_1st" => "2019-10-25", "md_hbs_imm_2nd" => "");
	
	echo json_encode($md_hbs_imm, JSON_UNESCAPED_UNICODE);
	
	$md_hbs_imm_json = */
	
	$use_time_json = '{"data": [{"abc": 123}, {"def": 234}]}';
	
	$use_time_array = json_decode($use_time_json);
	
	var_dump($use_time_array);
	
	
	if (in_array("아침", $use_time_array)) echo "checked";
?>




<?
	// FOOTER INCLUDE
	include "../footer.inc.php";
	
	// MYSQLi CLOSE
	$mysqli->close();
?>
