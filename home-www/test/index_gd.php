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
	list($hosp_nameplate_img) = $mysqli->query_fetch_first_row("SELECT get_data_img(nameplate_img) FROM mhb_hospital WHERE org_code = '" . $_SESSION["s_org_code"] . "'");
	
	echo $hosp_nameplate_img . "<br>";
	
	list($hosp_nameplate_img_w, $hosp_nameplate_img_h) = getimagesize($hosp_nameplate_img);
	
	$ratio_w = $hosp_nameplate_img_w / 160;
	
	$hosp_nameplate_img_resize_w = 180;
	$hosp_nameplate_img_resize_h = $hosp_nameplate_img_h / ($hosp_nameplate_img_w / $hosp_nameplate_img_resize_w);
	
	
	echo $hosp_nameplate_img_w . "<br>";
	echo $hosp_nameplate_img_h . "<br>";
	echo $ratio_w . "<br>";
	echo $hosp_nameplate_img_resize_w . "<br>";
	echo $hosp_nameplate_img_resize_h . "<br>";
	
?>




<?
	// FOOTER INCLUDE
	include "../footer.inc.php";
	
	// MYSQLi CLOSE
	$mysqli->close();
?>
