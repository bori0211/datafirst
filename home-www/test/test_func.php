#!/usr/bin/php
<?
	// ONLY CLI
	if (php_sapi_name() != "cli") exit("Command line Only.");
	
	// FUNCTION INCLUDE
	require __DIR__ . "/../config.inc.php";
	require __DIR__ . "/../set_init_data.inc.php";
	require __DIR__ . "/../function.inc.php";
	
	echo "TEST Start: " . date("Y-m-d H:i:s") . "\n\n\n";
	
	
	echo "abc\n\n";
	
	$sample_date = "{%22selec'ted_tab%22:%20%22all%22,%20%22filter%22:%20%22%22,%20%22nq%22:%20%22%EB%B0%95%EB%B3%B4%EB%9D%BC\\";
	
	echo $sample_date . "\n\n";
	
	$sample_date_after = str_replace(array("'", "\\"), array("''", "\\\\"), $sample_date);
	
	echo $sample_date_after . "\n\n";
	
	
	
	echo "TEST End: " . date("Y-m-d H:i:s") . "\n";
?>