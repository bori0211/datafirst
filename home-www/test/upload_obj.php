<?
	// REQUIRE FILES (필수)
	require "../config.inc.php";
	require "../set_init_data.inc.php";
	require "../function.inc.php";
	
	// MYSQLi INSTANCE
	$mysqli = mysqli_instance();
	
	
	
	class ResizeImageHandler {
		function __construct($filename) {
			$this->filename = $filename;
		}
		
		function resize() {
		}
	}
	
	class UploadImageHandler {
		function __construct($mysqli) {
			$this->mysqli = $mysqli;
		}
		
		static function deleteOldFile($mysqli, $resize_img) {
			$res = $mysqli->query("SELECT id, source_img, resize_img FROM sys_upload WHERE resize_img = '" . $resize_img . "'");
			
			if ($row = $res->fetch_row()) {
				$sys_upload_id = $row[0];
				$source_img = $row[1];
				$resize_img = $row[2];
				
				if (file_exists($_SERVER["DOCUMENT_ROOT"] . $source_img)) unlink($_SERVER["DOCUMENT_ROOT"] . $source_img);
				if (file_exists($_SERVER["DOCUMENT_ROOT"] . $resize_img)) unlink($_SERVER["DOCUMENT_ROOT"] . $resize_img);
				
				$mysqli->query("DELETE FROM sys_upload WHERE id = " . $sys_upload_id) or exit($mysqli->error);
			}
		}
		
		static function uploadAndResize($mysqli, $uploadType, $uploadFile, $resizeOption) {
			// 업로드
			$web_path = "/upload/" . $_SESSION["s_org_code"] . "/" . $uploadType;
			$os_path = addslashes($_SERVER["DOCUMENT_ROOT"] . $web_path);
			
			if (!is_dir($os_path . "/source")) {
				umask(0002);
				mkdir($os_path . "/source", 0755, true);
			}
			
			if (!is_dir($os_path . "/resize")) {
				umask(0002);
				mkdir($os_path . "/resize", 0755, true);
			}
			
			$source_img = $web_path . "/source/" . date("YmdHis") . "." . pathinfo($uploadFile["name"], PATHINFO_EXTENSION);
			$resize_img = $web_path . "/resize/" . date("YmdHis") . ".jpg";
			
			if (preg_match("/\.(jpe?g|gif|png)$/i", $source_img)) {
				if (move_uploaded_file($uploadFile["tmp_name"], $_SERVER["DOCUMENT_ROOT"] . $source_img)) {
					$image_magic = new ResizeImageHandler();
					
					if ($image_magic->resize($source_img, $resize_img, $resizeOption)) {
						// 이미지 용량
						$source_size = filesize($_SERVER["DOCUMENT_ROOT"] . $source_img);
						$resize_size = filesize($_SERVER["DOCUMENT_ROOT"] . $resize_img);
						
						// 업로드 파일
						$query = "INSERT INTO sys_upload (type, source_img, source_size, resize_img, resize_size, created_date) VALUES ";
						$query .= "('" . $upload_type . "', ";
						$query .= "'" . $source_img . "', ";
						$query .= $source_size . ", ";
						$query .= "'" . $resize_img . "', ";
						$query .= $resize_size . ", ";
						$query .= "SYSDATE())";
						
						$mysqli->query($query) or exit($mysqli->error);
						
						return $resize_img;
					}
					
					// 리사이즈가 되었다면
					if (resize_image($source_img, $resize_img, $resize_option) == 0) {
						
						// 기존 파일이 있다면 삭제
						
						return $resize_img;
						
						//return array("", $source_img, $source_size, $resize_img, $resize_size);
						
					} else {
						
						exit("resize fail.");
					}
					
				} else {
					
					exit("move_uploaded_file fail.");
				}
				
			} else {
				
				exit("only image file. (jpg, png, gif)");
			}
			
			exit("upload and resize fail.");
		}
	}
	
	if ($act == "insert") {
		phpinfo();
		
		
		
		if (is_uploaded_file($_FILES["product_img"]["tmp_name"])) {
			$upload_img = new UploadImageHandler($mysqli);
			
			$product_img = $upload_img->uploadAndResize("mdb_drug", $_FILES["product_img"], "[W400]");
			
			if ($product_img != "") {
				// 기존 이미지 삭제
				$image_uploader->deleteOld("배열, 원본, 리사이즈");
			}
			
			
			//$product_img->setOldResizeName("/upload/11111111/mdb_drug/resize/D015_20190507120337.png");
			$product_img->setResizeInfo("mdb_drug", "[W400]");
			
			if ($product_img->upload()) {
				echo "abc";
			}
			
			
			
			$old_product_img = "";
			
		}
	}
?>

<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>KL데모내과</title>
    <link rel="shortcut icon" href="/upload/11111111/favicon-16x16.png" type="image/png">
    <script src="/bower/jquery/dist/jquery.min.js?v=3.7.1"></script>
  </head>
  <body>
    <form action="<?= $PHP_SELF ?>" method="post" enctype="multipart/form-data">
      <input type="file" name="logo_img" accept=".jpg,.jpeg" value="" maxlength="20" style="width:18em;">
      <input type="hidden" name="act" value="insert">
      <input type="submit">
    </form>
  </body>
</html>

<?
	// MYSQLi CLOSE
	$mysqli->close();
?>
