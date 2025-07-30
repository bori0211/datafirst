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
	/*
	// 실행
	$exec_result = exec("/usr/bin/convert '/home/webframe/webframe/img/source/100002/20221109112536_10100731.jpg' -quality 100 -resize 600x '/home/webframe/webframe/img/hd1280/100002/20221109112536_10100731.jpg'", $output, $return_var);
	
	var_dump($output);
	
	var_dump($return_var);
	
	var_dump($exec_result);
	*/
	
	$usr_id = 1234;
	
	$img_path_hd1280_usr = IMAGE_PATH . "/hd1280/" . $usr_id;
	
	echo dirname($img_path_hd1280_usr);
	
	// Convert
	//$return_convert = make_resize_image($mysqli, $new_id);
	
	//if ($return_convert != 0) exit("Convert file fail.");
	
	
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
