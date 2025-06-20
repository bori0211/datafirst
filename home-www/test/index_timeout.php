<?
	// REQUIRE FILES (필수)
	require "../config.inc.php";
	require "../set_init_data.inc.php";
	require "../function.inc.php";
	
	
	
	// Setting
	//echo ini_get('max_execution_time');
	
	
	
	// SLEEP
	//sleep(65);
	
	
	
	
	// MYSQLi INSTANCE
	$mysqli = mysqli_instance();
	
	// MySQL
	list($sleep) = $mysqli->query_fetch_first_row("SELECT SLEEP(1)");
	
	// MYSQLi CLOSE
	$mysqli->close();
?>

<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>WebFrame Timeout Test</title>
    <link rel="shortcut icon" href="/upload/11111111/favicon-16x16.png" type="image/png">
    <script src="/bower/jquery/dist/jquery.min.js?v=3.5.1"></script>
  </head>
  
  <body>
    <div class="content">
      <div class="content-header">
        <h1 class="content-title">Timeout</h1>
      </div>
      
      <div class="content-body">
        <div class="container-fluid">
        <table class="table table-bordered table-striped px-3">
          <thead>
            <tr>
              <th>보기</th>
              <th>코드</th>
              <th>이름</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
        </div>
        
            <!--
            <div class="container px-0">
            <div class="row pb-3">
              <div class="col-md-12">
                1234
              </div>
            </div>
            </div>
            -->
        

        
      </div>
    </div>
    
    
<script>
/*
var logoutTimer;
var logoutTimer2;

    // auto logout (세션 2시간)
    logoutTimer = setTimeout(function() {
      console.log("5sec timeout");
    }, 5 * 1000);
    
    // auto logout (세션 2시간)
    logoutTimer2 = setTimeout(function() {
      console.log("5sec timeout 2");
    }, 5 * 1000);
    
    
    console.log(logoutTimer);
    console.log(logoutTimer2);
    
    clearTimeout(logoutTimer);
*/
</script>

    
  </body>
</html>
