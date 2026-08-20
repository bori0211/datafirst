<?
	// REQUIRE FILES (필수)
	require "../config.inc.php";
	require "../set_init_data.inc.php";
	require "../function.inc.php";
	
	// MYSQLi INSTANCE
	$mysqli = mysqli_instance();
	
	
	
	echo round(58.54, 1);
	
	// CENTRAL
	echo $_SERVER["HTTP_HOST"];
	
	echo "<br>";
	
	var_dump(explode(".", $_SERVER["HTTP_HOST"]));
	
	echo "<br>";
	
	
	echo $_SERVER["REQUEST_URI"];
	
	echo "<br>";
	
	var_dump(explode("/", $_SERVER["REQUEST_URI"]));
	
	$host = array_shift(explode(".", $_SERVER["HTTP_HOST"]));
	
	
	echo "<br>";
	
	if (str_starts_with($_SERVER["REQUEST_URI"], "/admin"))
		echo "test";
	else
		echo "else";
	
	
	echo "<br><br>";
	
	$history_drug_name = "카베디아정25mg";
	
	$history_drug_name = mb_strimwidth($history_drug_name ?? "", 0, 13, "...", "utf-8");
	
	//if (mb_strlen($history_drug_name, "UTF-8") > 8)
	//	$history_drug_name = mb_substr($history_drug_name, 0, 5, "UTF-8") . "...";
	
	echo $history_drug_name . "<br>";
	
	
	
	// MYSQLi CLOSE
	$mysqli->close();
?>
