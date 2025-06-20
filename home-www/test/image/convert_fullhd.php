<?
	// REQUIRE FILES (필수)
	require "../config.inc.php";
	require "../set_init_data.inc.php";
	require "../function.inc.php";
	
	// MYSQLi INSTANCE
	$mysqli = mysqli_instance();
	
	
	
	// HEADER INCLUDE
	include "../header.inc.php";
?>

    <div class="content">
      <div class="content-header">
        <h1 class="content-title">Home</h1>
      </div>
      
      <div class="content-body">
<?
	// WHERE & ORDER
	$where = " WHERE TRUE";
	$order = " ORDER BY id ASC";
	
	$query = "SELECT id, usr_id, get_image_url(id, 'source'), DATE_FORMAT(regi_date, '%Y%m%d%H%i%s') FROM img";
	$query .= $where . $order . $limit;
	
	$res = $mysqli->query($query) or exit($mysqli->error);
	
	while ($row = $res->fetch_row()) {
		$id = $row[0];
		$usr_id = $row[1];
		$source_img_url = $row[2];
		$regi_date = $row[3];
		
		list($source_img_w, $source_img_h) = getimagesize($source_img_url);
		
		if ($source_img_w > $source_img_h) $desire_size = "W1920";
		if ($source_img_w < $source_img_h) $desire_size = "H1920";
		if ($source_img_w == $source_img_h) $desire_size = "X1920,1920";
		
		
		
		
		// Orignal 복사
		$usr_path = ORIGNAL_IMG_PATH . "/" . $usr_id;
		
		if (!is_dir($usr_path)) {
			//umask(0002);
			mkdir($usr_path, 0755, true);
		}
		
		$path_parts = pathinfo($work_img_url);
		
		$orignal_name = $regi_date . "_" . $id . "." . $path_parts["extension"];
		
		$orignal_img = $usr_path . "/" . $orignal_name;
		$orignal_img_url = ORIGNAL_IMG_URL . "/" . $usr_id . "/" . $orignal_name;
		
		// 원본을 복사 했다면
		if (copy($work_img_url, $orignal_img)) {
			// Resize
			list($orignal_img_w, $orignal_img_h) = getimagesize($orignal_img);
			
			// 썸네일 이미지 정보 저장
			$query = "UPDATE ctt SET ";
			$query .= "orignal_img_url = '" . $orignal_img_url . "', ";
			$query .= "orignal_img_w = " . $orignal_img_w . ", ";
			$query .= "orignal_img_h = " . $orignal_img_h . ", ";
			$query .= "last_modi_date = SYSDATE() ";
			$query .= "WHERE usr_id = " . $usr_id . " AND id = " . $id;
			
			$mysqli->query($query) or exit($mysqli->error);
			
		} else {
			
			exit("orignal copy fail.");
		}
		
		
		
		echo $work_img_url . "<br>";
	}
?>
        
      </div>
    </div> <!-- .content -->
    
<script>
$(document).ready(function() {
});
</script>



<?
	// FOOTER INCLUDE
	include "../footer.inc.php";
	
	// MYSQLi CLOSE
	$mysqli->close();
?>
