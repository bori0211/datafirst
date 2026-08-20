<?
	// REQUIRE FILES (필수)
	require "../config.inc.php";
	require "../set_init_data.inc.php";
	require "../function.inc.php";
	
	// MYSQLi INSTANCE
	$mysqli = mysqli_instance();
	
	echo "<!DOCTYPE html>\n";
	
	
	
	
	
	// test_image
	function test_image() {
		
		global $logger;
		
		//var_dump($this);
		
		
		//var_dump(MONOLOG_PATH);
		
		$context = ['foo' => 'bar'];
		
		//$logger->error("convert exec 실패", $context);
		$logger->error("convert exec 실패 33");
		
		
	// Monolog
	//use Monolog\Logger;
	//use Monolog\Handler\StreamHandler;
	//use Monolog\Formatter\LineFormatter;
		
		/*
		global Monolog\Logger;
		global StreamHandler;
		
		// Create a log channel
		$logger2 = new Monolog\Logger("UPLOAD");
		$handler2 = new Monolog\Handler\StreamHandler(MONOLOG_PATH . "/monolog.log", Logger::INFO);
		$handler2->setFormatter(new LineFormatter("[%datetime%] [%channel%] [%level_name%] %message%\n", "Y-m-d H:i:s"));
		$logger2->pushHandler($handler2);
		
		$logger2->error("convert exec 실패 3344");
		*/
	}
	
	test_image();
?>


TEST


<?
	// MYSQLi CLOSE
	$mysqli->close();
?>
