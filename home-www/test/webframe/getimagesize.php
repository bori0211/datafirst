<?
	// REQUIRE FILES (필수)
	require "../config.inc.php";
	require "../set_init_data.inc.php";
	require "../function.inc.php";
	
	// MYSQLi INSTANCE
	$mysqli = mysqli_instance();
	
	$selected_menu_id = 213;
	
	$PHP_SELF = "/patient-regular";
	
	
	
	// HEADER INCLUDE
	include "../header.inc.php";
?>

    <div class="content">
      <div class="content-header">
        <h1 class="content-title">Home</h1>
        <div>
          <strong id="total-row-cnt">???</strong>개의 트윗
        </div>
      </div>
      
      <div class="content-body">
<?
	$work_img_url = "https://upload.wikimedia.org/wikipedia/commons/b/b4/Vincent_Willem_van_Gogh_128.jpg";
	
	$imageinfo = getimagesize($work_img_url);
	
	var_dump($imageinfo);
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
