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
   
<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://maps.googleapis.com/maps/api/place/findplacefromtext/json?fields=place_id,formatted_address,name,geometry,photos&input=%EA%B5%AD%EB%A6%BD%EC%A4%91%EC%95%99%EB%B0%95%EB%AC%BC%EA%B4%80&inputtype=textquery&key=' . YOUTUBE_KEY,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

?>

 </div>

<script>
$(document).ready(function() {
  var searchData = {
    "fields": "place_id,formatted_address,name,geometry,photos,name",
    "input": "국립중앙박물관",
    "inputtype": "textquery",
    "key": YOUTUBE_KEY
  };
  
  $.get("https://maps.googleapis.com/maps/api/place/findplacefromtext/json", searchData, function(response) {
    console.log(response);
  }, "json").fail(function(xhr) {
    //toastr.error(xhr.responseText);
    console.log(xhr);
  });
});
</script>

<?
	// FOOTER INCLUDE
	include "../footer.inc.php";
	
	// MYSQLi CLOSE
	$mysqli->close();
?>
