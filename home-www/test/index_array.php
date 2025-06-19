<?
	// REQUIRE FILES (필수)
	require "../config.inc.php";
	require "../set_init_data.inc.php";
	require "../function.inc.php";
	
	// MYSQLi INSTANCE
	$mysqli = mysqli_instance();
	
	$selected_menu_id = 411;
	
	$PHP_SELF = "/dialysis/bloodline";
	
	
	
	// HEADER INCLUDE
	include "../header.inc.php";
?>




<?
	var_dump(array(IMAGETYPE_JPEG, IMAGETYPE_PNG));
	
	$md_hbs_imm = array("md_hbs_imm_1st" => "2019-10-25", "md_hbs_imm_2nd" => "");
	
	//var_dump($md_hbs_imm);
	
	//if (in_array("아침", $use_time_array)) echo "checked";
	
	$jbary = array( 'one', 'two', 'three' );
	$jbstr = implode( '/', $jbary );
	
	echo $jbstr;
?>




<?
	// FOOTER INCLUDE
	include "../footer.inc.php";
	
	// MYSQLi CLOSE
	$mysqli->close();
?>
