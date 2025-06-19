<?
	// REQUIRE FILES (필수)
	require "../config.inc.php";
	require "../set_init_data.inc.php";
	require "../function.inc.php";
	
	// MYSQLi INSTANCE
	$mysqli = mysqli_instance();
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
    <form class="entry-form" action="/parts/rows/pat_test_result_gccorp.php" method="post" enctype="multipart/form-data">
      <input type="file" name="result_file" value="" maxlength="20" style="width:18em;">
      <input type="hidden" name="act" value="insert">
      <input type="hidden" name="test_date_type" value="기본">
      <input type="hidden" name="appoint_test_date" value="20211227">
      
      
      
      <input type="submit">
    </form>
    
<script>
$(document).ready(function() {
  /*
  $("body").on("change", "form :input[type='file']", function(e) {
    e.preventDefault();
    console.log("body tag file change");
  });
  
  $(".entry-form").on("change", ":input[type='file']", function(e) {
    e.preventDefault();
    e.stopPropagation();
    console.log("entry-form file change");
  });
  */
});
</script>
    
  </body>
</html>

<?
	// MYSQLi CLOSE
	$mysqli->close();
?>
