<?
	// FUNCTION INCLUDE
	require "../../config.inc.php";
	require "../../function.inc.php";
	
	$cli_start_time = getmicrotime();
	
	echo "Start: " . date("Y-m-d H:i:s") . "\n\n";
	
	
	
	// CENTRAL
	$mysqli_central = mysqli_instance("central");
	
	$query_central = "SELECT host, org_code FROM sys_hospital";
	$query_central .= " WHERE org_code <> '11111111'";
	$query_central .= " ORDER BY kl_code ASC";
	
	$res_central = $mysqli_central->query($query_central) or exit($mysqli_central->error);
	
	while ($row_central = $res_central->fetch_row()) {
		$central_host = $row_central[0];
		$central_org_code = $row_central[1];
		
		echo $central_host . "\n";
		
		// config에 설정된 db만
		if (!isset($db_config["local"][$central_host])) continue;
		
		// 로컬 DB에 연결
		$mysqli = mysqli_instance("local", $central_host);
		
		$mysqli->begin_transaction() or exit($mysqli->error);
		
		
		
		echo "\tsys_upload check\n\n";
		
		// sys_upload
		$query = "SELECT cht_num, privacy_img FROM pat";
		$query .= " WHERE privacy_img IS NOT NULL";
		$query .= " ORDER BY cht_num ASC";
		
		$res = $mysqli->query($query) or exit($mysqli->error);
		
		for ($list_cnt = 1; $row = $res->fetch_row(); $list_cnt++) {
			$cht_num = $row[0];
			$privacy_img = $row[1];
			
			echo $cht_num . ":" . $privacy_img . "\n";
			
			
			/*
			// 기존 파일 삭제
			
			// source_img, resize_img
			list($source_img, $resize_img) = $mysqli->query_fetch_first_row("SELECT source_img, resize_img FROM sys_upload WHERE resize_img = '" . $privacy_img . "'");
			
			$source_img_path = IMAGE_PATH . $source_img;
			$resize_img_path = IMAGE_PATH . $resize_img;
			
			if (is_file($source_img_path) && is_file($resize_img_path)) {
				
				echo "delete\n";
				
				if (unlink($source_img_path) && unlink($resize_img_path)) {
					
					$query = "DELETE FROM sys_upload ";
					$query .= " WHERE resize_img = '" . $privacy_img . "'";
					
					$mysqli->query($query) or exit($mysqli->error);
					
					
					$query = "UPDATE pat SET ";
					$query .= "privacy_img = NULL, ";
					$query .= "updated_date = SYSDATE() ";
					$query .= "WHERE cht_num = '" . $cht_num . "'";
					
					$mysqli->query($query) or exit($mysqli->error);
					
				}
			}
			*/
			
			
			/*
			// 기존 파일 복사
			
			// file copy
			$upload_type = "pat_privacy";
			
			// OS Path
			$os_path = IMAGE_PATH . "/" . $central_org_code . "/" . $upload_type;
			
			if (is_dir($os_path) != true) {
				mkdir($os_path, 0755, true);
			}
			
			if (is_dir($os_path . "/source") != true) {
				mkdir($os_path . "/source", 0755, true);
			}
			
			if (is_dir($os_path . "/resize") != true) {
				mkdir($os_path . "/resize", 0755, true);
			}
			
			
			// source_img, resize_img
			list($source_img, $resize_img) = $mysqli->query_fetch_first_row("SELECT source_img, resize_img FROM sys_upload WHERE resize_img = '" . $privacy_img . "'");
			
			$source_img_path = IMAGE_PATH . $source_img;
			$resize_img_path = IMAGE_PATH . $resize_img;
			
			if (is_file($source_img_path) && is_file($resize_img_path)) {
				
				$source_img_dest = str_replace("/pat/", "/pat_privacy/", $source_img_path);
				$resize_img_dest = str_replace("/pat/", "/pat_privacy/", $resize_img_path);
				
				echo "\n";
				echo "source:" . $source_img_dest . "\n";
				echo "resize:" . $resize_img_dest . "\n";
				
				if (copy($source_img_path, $source_img_dest) && copy($resize_img_path, $resize_img_dest)) {
					
					echo "copy ok\n";
					
					
					
					// 이미지 용량
					$source_size = filesize($source_img_dest);
					$resize_size = filesize($resize_img_dest);
					
					$web_source_img = str_replace("/pat/", "/pat_privacy/", $source_img);
					$web_resize_img = str_replace("/pat/", "/pat_privacy/", $resize_img);
					
					// 업로드 파일
					$query = "INSERT INTO sys_upload (type, source_img, source_size, resize_img, resize_size, created_date) VALUES ";
					$query .= "('" . $upload_type . "', ";
					$query .= "'" . $web_source_img . "', ";
					$query .= $source_size . ", ";
					$query .= "'" . $web_resize_img . "', ";
					$query .= $resize_size . ", ";
					$query .= "SYSDATE())";
					
					$mysqli->query($query) or exit($mysqli->error);
					
					
					
					list($num) = $mysqli->query_fetch_first_row("SELECT IFNULL(MAX(num), 0) + 1 FROM pat_privacy WHERE cht_num = '" . $cht_num . "'");
					
					$data_img = $web_resize_img;
					
					$query = "INSERT INTO pat_privacy (cht_num, num, data_img, created_date) VALUES ";
					$query .= "('" . $cht_num . "', ";
					$query .= $num . ", ";
					$query .= "'" . $data_img . "', ";
					$query .= "SYSDATE())";
					
					$mysqli->query($query) or exit($mysqli->error);
					
				}
			}
			
			*/
		}
		
		
		
		$mysqli->commit() or exit($mysqli->error);
		
		$mysqli->close();
	}
	
	$mysqli_central->close();
	
	
	
	echo "\n";
	echo "End: " . date("Y-m-d H:i:s") . " (" . round((getmicrotime() - $cli_start_time) / 60, 2)  . "min)" . "\n";
?>