<?
	// REQUIRE FILES (필수)
	require "../config.inc.php";
	require "../set_init_data.inc.php";
	require "../function.inc.php";
	
	// MYSQLi INSTANCE
	$mysqli = mysqli_instance();
	
	echo "<!DOCTYPE html>\n";
	
	
	
	$client = new Google_Client();
	$client->setAuthConfig('../test/google_client_credentials.json');
	//$client->addScope("email");
	$client->addScope("profile");
	
	// Your redirect URI can be any registered URI, but in this example
	// we redirect back to this same page
	$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
	$client->setRedirectUri($redirect_uri);
	
	
	
	// MYSQLi CLOSE
	$mysqli->close();
?>
