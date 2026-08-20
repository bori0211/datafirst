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
	$var = new stdClass();
	
	$var->propp1 = "nice";
	$var->propp2 = 1234;
	
	var_dump($var);
?>




<?
	// FOOTER INCLUDE
	include "../footer.inc.php";
	
	// MYSQLi CLOSE
	$mysqli->close();
?>
