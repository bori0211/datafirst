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
	$where = " WHERE TRUE AND exif_data IS NULL";
	$order = " ORDER BY id ASC";
	
	$query = "SELECT id, usr_id, get_image_url(id, 'source'), DATE_FORMAT(regi_date, '%Y%m%d%H%i%s') FROM img";
	$query .= $where . $order . $limit;
	
	$res = $mysqli->query($query) or exit($mysqli->error);
	
	while ($row = $res->fetch_row()) {
		$id = $row[0];
		$usr_id = $row[1];
		$source_img = $row[2];
		$regi_date = $row[3];
		
		//echo $source_img . "<br>";
		
		$exif_data = getimage_exif($source_img);
		
		if (is_array($exif_data)) {
			// EXIF 정보 저장
			$query = "UPDATE img SET ";
			$query .= "exif_data = '" . json_encode($exif_data) . "', ";
			$query .= "last_modi_date = SYSDATE() ";
			$query .= "WHERE id = " . $id;
			
			$mysqli->query($query) or exit($mysqli->error);
		}
		
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
