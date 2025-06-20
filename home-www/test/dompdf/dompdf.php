<?php
	require '../vendor/autoload.php';
	
	// reference the Dompdf namespace
	use Dompdf\Dompdf;
	use Dompdf\Options;
	
	$options = new Options();
	$options->setChroot(__DIR__);
	$options->setIsPhpEnabled(true);
	$options->setIsRemoteEnabled(true);
	
	
	$tmp = sys_get_temp_dir();
	//$options->setFontDir($tmp);
	//$options->setFontCache($tmp);
	$options->setFontDir(__DIR__ . '/fonts/cache');
	$options->setFontCache(__DIR__ . '/fonts/cache');
	
	
	// instantiate and use the dompdf class
	$dompdf = new Dompdf($options);
	//$dompdf->loadHtml('hello world 한글은');
	$dompdf->loadHtmlFile("dompdf_html_font.html");
	
	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'landscape');
	
	// Render the HTML as PDF
	$dompdf->render();
	
	// Output the generated PDF to Browser
	$dompdf->stream("abc.pdf", ["Attachment" => 0]);
?>
