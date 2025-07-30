<?
	// REQUIRE FILES (ÇÊ¼ö)
	require "../config.inc.php";
	require "../set_init_data.inc.php";
	require "../function.inc.php";
	
	// Include the main DOMPDF library
	require("./dompdf_bsfa.inc.php");
	require "./mhb_user.inc.php";
	
	// MYSQLi INSTANCE
	$mysqli = mysqli_instance();
	
	
	
	// reference the Dompdf namespace
	use Dompdf\Dompdf;
	use Dompdf\Options;
	
	$options = new Options();
	$options->setChroot(__DIR__ . "/..");
	$options->setIsPhpEnabled(true);
	$options->setIsRemoteEnabled(true);
	$options->set("defaultFont", "malgungothic");
	
	$options->setFontDir(IMAGE_PATH . "/dompdf-font-cache");
	$options->setFontCache(IMAGE_PATH . "/dompdf-font-cache");
	
	$options->setLogOutputFile(IMAGE_PATH . "/dompdf.log");
	//$options->setDebugCss(true);
	$options->setDebugLayout(true);
	//$options->setDebugLayoutLines(true);
	//$options->setDebugLayout(true);
	
	
	
	// instantiate and use the dompdf class
	$dompdf = new Dompdf($options);
	
	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper("A4", "portrait");
	
	$header = get_header($mysqli);
	$item = get_mhb_user($mysqli, 16);
	$footer = get_footer($mysqli);
	
	$html = $header . $item . $footer;
	
	var_dump($html);
	
	$dompdf->loadHtml($html);
	
	
	
	// Render the HTML as PDF
	//$dompdf->render();
	
	// Output the generated PDF to Browser
	//$dompdf->stream("abc.pdf", ["Attachment" => 0]);
	
	
	
	// MYSQLi CLOSE
	$mysqli->close();
?>