<?php
	
	// REQUIRE FILES (필수)
	require "../../config.inc.php";
	require "../../set_init_data.inc.php";
	require "../../function.inc.php";
	
	
	// reference the Dompdf namespace
	use Dompdf\Dompdf;
	use Dompdf\Options;
	
	
	$options = new Options();
	$options->setChroot(__DIR__ . "/..");
	$options->setIsPhpEnabled(true);
	$options->setIsRemoteEnabled(true);
	$options->set("defaultFont", "malgungothic");
	
	$tmp = sys_get_temp_dir();
	//$options->setFontDir($tmp);
	//$options->setFontCache($tmp);
	$options->setFontDir(IMAGE_PATH . '/dompdf-font-cache');
	$options->setFontCache(IMAGE_PATH . '/dompdf-font-cache');
	
	
	// instantiate and use the dompdf class
	$dompdf = new Dompdf($options);
	//$dompdf->loadHtml('hello world 한글은');
	$dompdf->loadHtmlFile("dompdf_long_table.html");
	//$dompdf->loadHtmlFile("dompdf_header_footer.php");
	//$dompdf->loadHtmlFile("/phpinfo.php");
	
	
	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'landscape');
	
	// Render the HTML as PDF
	$dompdf->render();
	
	// Output the generated PDF to Browser
	$dompdf->stream("abc.pdf", ["Attachment" => 0]);
?>