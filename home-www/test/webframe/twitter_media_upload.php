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
                
  <form id="pic-form" method="post" role="form" enctype="multipart/form-data" action="./twitter_media_upload_process.php">
  
  <div class="dropdown-form" style="width:580px;">
    
    <div class="row">
      <label class="col-md-3 col-form-label text-md-end pe-0"><span class="text-danger">*</span> 작품 이미지</label>
      <div class="col-md-9">
        <div class="form-inline">
          <input class="form-control" type="file" name="work_img" accept="image/png,image/jpeg,image/gif" value="" maxlength="20" style="width:18em;">
        </div>
      </div>
    </div>
    
    <div class="row">
      <label class="col-md-3 col-form-label text-md-end pe-0"><span class="text-danger">*</span> 제목</label>
      <div class="col-md-9">
        <div class="form-inline">
          <input class="form-control" type="text" name="title" value="<?= $title ?>" maxlength="40" style="width:20em;">
        </div>
      </div>
    </div>
    
    <div class="row">
      <label class="col-md-3 col-form-label text-md-end"><!-- BLANK --></label>
      <div class="col-md-9">
        <div class="form-inline">
          <button class="btn btn-primary save-btn px-3" type="submit">저장</button>
        </div>
      </div>
    </div>
    
  </div>
  
  <input type="hidden" name="act" value="insert">
  </form>
                
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
