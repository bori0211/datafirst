<?
	// REQUIRE FILES (필수)
	require "./config.inc.php";
	require "./set_init_data.inc.php";
	require "./function.inc.php";
	
	// MYSQLi INSTANCE
	$mysqli = mysqli_instance();
	
	
	
	header("Content-Type: application/xml; charset=utf-8");
	
	echo '<?xml version="1.0" encoding="UTF-8"?>';
	echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
	
	$hemochart_contents = array(
		array("/", "/index.php"),
		array("/kidneylife", "/kidneylife.php"),
		array("/catalog", "/catalog.php"),
		array("/faq", "/faq.php")
	);
	
	foreach ($hemochart_contents as $content) {
		list($url, $filename) = $content;
		
		$loc = "https://www.hemochart.com" . $url;
		$lastmod = date("Y-m-d\TH:i:s+09:00", filemtime(__DIR__ . $filename));
		
		echo '<url>';
		echo '<loc>' . $loc . '</loc>';
		echo '<lastmod>' . $lastmod . '</lastmod>';
		echo '<changefreq>daily</changefreq>';
		echo '<priority>1.00</priority>';
		echo '</url>';
	}
	
	echo '</urlset>';
	
	
	
	// MYSQLi CLOSE
	$mysqli->close();
?>