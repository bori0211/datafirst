<?
	// REQUIRE FILES (필수)
	require "./config.inc.php";
	require "./set_init_data.inc.php";
	require "./function.inc.php";
	
	// MYSQLi INSTANCE
	$mysqli = mysqli_instance();
	
	$selected_menu_id = 411;
	
	$PHP_SELF = "/dialysis/bloodline";
	
	
	
	// HEADER INCLUDE
	include "./header.inc.php";
?>




<?
	var_dump(HD_TIME[0]);
	echo "<br>";
	echo PHP_INT_SIZE;
	echo "<br>";
	echo var_dump($GLOBALS);
	
	//phpinfo();
	
	// WHERE & ORDER
	$where = " WHERE TRUE";
	$order = " ORDER BY code ASC";
	
	// COUNT
	list($total_row_cnt) = $mysqli->query_fetch_first_row("SELECT COUNT(*) FROM mdb_bloodline" . $where);
?>
    
    <div class="content">
      <div class="content-header">
        <h1 class="content-title"><?= SYS_MENU[$selected_menu_id] ?></h1>
        <div>
          <strong><?= number_format($total_row_cnt) ?></strong>개의 Bloodline
          <a class="btn btn-default btn-xs btn-flat refresh-btn d-none" href="<?= $PHP_SELF ?>"><i class="fas fa-redo fa-fw"></i></a>
        </div>
      </div>
      
      <div class="content-body">
        <div class="container-fluid">
        <table class="table table-bordered table-striped px-3">
          <thead class="table-head">
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




<?
	// FOOTER INCLUDE
	include "./footer.inc.php";
	
	// MYSQLi CLOSE
	$mysqli->close();
?>
