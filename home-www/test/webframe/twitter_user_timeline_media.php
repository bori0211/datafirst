<?
	// REQUIRE FILES (필수)
	require "../config.inc.php";
	require "../set_init_data.inc.php";
	require "../function.inc.php";
	
	// MYSQLi INSTANCE
	$mysqli = mysqli_instance();
	
	echo "<!DOCTYPE html>\n";
?>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no,user-scalable=no">
    <title>TEST</title>
    <link rel="shortcut icon" type="image/png" href="/assets/favicon-32x32.png">
    <!--<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:200,400,700|Raleway:200,400,700|Open+Sans:200,400,700|Noto+Sans+KR">-->
    <link rel="stylesheet" href="/bower/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/bower/fontawesome/css/all.min.css">
    <script src="/bower/jquery/dist/jquery.min.js"></script>
  </head>
  
  <body>

    <div class="content">
      <div class="content-header">
        <h1 class="content-title">Home</h1>
        <div>
          <strong id="total-row-cnt">???</strong>개의 트윗
        </div>
      </div>
      
      <div class="content-body">
        <div class="container-fluid">
                
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>트윗</th>
                      <th>Media</th>
                    </tr>
                  </thead>
                  <tbody>
<?
	$twitter = new Abraham\TwitterOAuth\TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $_COOKIE["c_sns_oauth_token"], $_COOKIE["c_sns_oauth_token_secret"]);
	
	//$user_timeline = $twitter->get("statuses/user_timeline", ["screen_name" => "moonriver365"]);
	$user_timeline = $twitter->get("statuses/user_timeline", ["user_id" => "1138350757663535105"]);
	
	foreach ($user_timeline as $tweet) {
		$id_str = $tweet->id_str;
		$text = $tweet->text;
		$medias = $tweet->extended_entities->media;
		
		$text_display = $text;
		if (mb_strlen($text_display, "UTF-8") > 33)
			$text_display = mb_substr($text_display, 0, 30, "UTF-8") . "...";
		
		//if ($id_str == "361070498290999296")
		//	var_dump($media);
		
		// media가 있을 때
		if (is_array($medias)) {
			//var_dump(count($medias));
			for ($media_cnt = 0; $media_cnt < count($medias); $media_cnt++) {
				$work_img = $medias[$media_cnt]->media_url_https;
				//var_dump($medias[$media_cnt]->media_url);
?>
                    <tr>
                      <td class="text-center"><?= $id_str ?></td>
                      <td class="text-start"><?= $text_display ?></td>
                      <td class="text-start"><?= $work_img ?></td>
                    </tr>
<?
			}
		}
	}
?>
                  </tbody>
                </table>
                
        </div>
      </div>
      
      <div class="content-footer">
        
      </div>
    </div> <!-- .content -->
    
<script>
$(document).ready(function() {
});
</script>

    <script src="/bower/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/bower/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    
  </body>
</html>

<?
	// MYSQLi CLOSE
	$mysqli->close();
?>
