<?
	// REQUIRE FILES (필수)
	require "../config.inc.php";
	require "../set_init_data.inc.php";
	require "../function.inc.php";
	
	header("Content-Type: application/json; charset=utf-8");
	
	// MYSQLi INSTANCE
	$mysqli = mysqli_instance();
	
	
	
	exit("abced");
	
	if (is_uploaded_file($_FILES["file"]["tmp_name"])) {
		$today_year = date("Y");
		$today_md = date("md");
		
		$dir_path = addslashes("/home/webframe/webframe/img/logs/" . $today_year . "/" . $today_md);
		if (!is_dir($dir_path)) {
			//umask(0002);
			mkdir($dir_path, 0775, true);
		}
		
		$id = "Ymdhis";
		
		// 파일 정보
		$file_os_dir = $dir_path;
		$file_web_dir = "/attach/" . $today_year . "/" . $today_md;
		$file_name_org = $_FILES["file"]["name"];
		$file_name = $id . "_" . $_FILES["file"]["name"];
		$file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
		$file_size = $_FILES["file"]["size"];
		$file_type = $_FILES["file"]["type"];
		
		if (preg_match("/\.(jpe?g|gif|png)$/i", $file_name) && preg_match("/^image/i", $file_type)) {
			if (move_uploaded_file($_FILES["file"]["tmp_name"], $dir_path . "/" . $file_name)) {
				
				echo "OK";
			}
		}
	}
	
	
	
	// MYSQLi CLOSE
	$mysqli->close();
?>