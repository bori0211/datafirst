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
	$v_qbn = 300;
	$v_qbx = 300;
	$v_ufr = 600;
	$v_rn = 7;
	$v_rx = 27;
	
	$child = ($v_qbx - ($v_ufr / 60)) * (1 - ($v_rx / 100) - ($v_rn / 100) + (($v_rx / 100) * ($v_rn / 100)));
	//$child = (1 - ($v_rx / 100) - ($v_rn / 100) + (($v_rx / 100) * ($v_rn / 100)));
	
	$mother1 = ($v_rx / 100) - (($v_rx / 100) * ($v_rn / 100));
	
	$mother2_1 = ($v_qbx - ($v_ufr / 60)) / $v_qbn;
	
	var_dump($mother2_1);
?>




<?
	// FOOTER INCLUDE
	include "../footer.inc.php";
	
	// MYSQLi CLOSE
	$mysqli->close();
?>
