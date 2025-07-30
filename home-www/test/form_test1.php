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
	//list($sleep) = $mysqli->query_fetch_first_row("SELECT SLEEP(15)");
	
	// MYSQLi CLOSE
	$mysqli->close();
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
    


<div class="modal-dialog modal-lg">
    <div class="modal-content">



      <form method="post" role="form" id="modal-db-form" action="/phpinfo">
      
      <div class="modal-header">
        <h2 class="modal-title">발주 품목</h2>
        <div class="ms-auto d-flex">
          <a class="list-btn d-none" href="/modals/sto_order_enter.php"><i class="fas fa-list fa-fw"></i></a>
          <button class="btn btn-modal-icon" type="button" data-bs-dismiss="modal"><i class="fas fa-times fa-fw" style="font-size:16px;"></i></button>
        </div>
      </div>
      
      <div class="modal-body pt-0 pb-3">
        <div class="container-fluid">
          
          <div class="table-header-info p-3">
            <div class="row">
              <div class="col-4 text-center">
                발주일: <strong>2021-10-28</strong>
              </div>
              <div class="col-4 text-center">
                공급자: <strong>키드니라이프</strong>
              </div>
              <div class="col-4 text-center">
                              납기일: <strong>2021-11-01</strong>
                            </div>
            </div>
          </div>
          
          <table class="table table-bordered table-striped">
            <thead class="table-head">
              <tr>
                <th>No</th>
                <th>분류</th>
                <th>코드</th>
                <th>품목명</th>
                <th>수량</th>
                <th>단위</th>
                <th>박스 수량</th>
                <th>입고 수량</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center"><input type="checkbox" name="entity[]" value="sto_dialyser" checked=""></td>
                <td class="text-center">투석기</td>
                <td class="text-center">
                  X10                  <input type="hidden" name="pdt_code[]" value="X10">
                </td>
                <td class="text-start">Xevonta 10</td>
                              <td class="text-center">
                  <div class="form-inline justify-content-center">
                    <input class="form-control text-end" type="text" name="qty[]" value="200" maxlength="5" style="width:4em;">
                  </div>
                </td>
                <td class="text-center">개</td>
                <td class="text-center">
                  <div class="form-inline justify-content-center">
                    <input class="form-control text-end" type="text" name="box_qty[]" value="1" maxlength="5" style="width:3em;">
                  </div>
                </td>
                <td class="text-center">
                  <div class="form-inline justify-content-center">
                    <input class="form-control text-end" type="text" name="enter_qty[]" value="1" maxlength="5" style="width:4em;">
                  </div>
                </td>
                            </tr>
              <tr>
                <td class="text-center"><input type="checkbox" name="entity[]" value="sto_dialyser" checked=""></td>
                <td class="text-center">투석기</td>
                <td class="text-center">
                  X15                  <input type="hidden" name="pdt_code[]" value="X15">
                </td>
                <td class="text-start">Xevonta 15</td>
                              <td class="text-center">
                  <div class="form-inline justify-content-center">
                    <input class="form-control text-end" type="text" name="qty[]" value="180" maxlength="5" style="width:4em;">
                  </div>
                </td>
                <td class="text-center">개</td>
                <td class="text-center">
                  <div class="form-inline justify-content-center">
                    <input class="form-control text-end" type="text" name="box_qty[]" value="1" maxlength="5" style="width:3em;">
                  </div>
                </td>
                <td class="text-center">
                  <div class="form-inline justify-content-center">
                    <input class="form-control text-end" type="text" name="enter_qty[]" value="1" maxlength="5" style="width:4em;">
                  </div>
                </td>
                            </tr>
              <tr>
                <td class="text-center"><input type="checkbox" name="entity[]" value="sto_dialyser" checked=""></td>
                <td class="text-center">투석기</td>
                <td class="text-center">
                  X12                  <input type="hidden" name="pdt_code[]" value="X12">
                </td>
                <td class="text-start">Xevonta 12</td>
                              <td class="text-center">
                  <div class="form-inline justify-content-center">
                    <input class="form-control text-end" type="text" name="qty[]" value="120" maxlength="5" style="width:4em;">
                  </div>
                </td>
                <td class="text-center">개</td>
                <td class="text-center">
                  <div class="form-inline justify-content-center">
                    <input class="form-control text-end" type="text" name="box_qty[]" value="1" maxlength="5" style="width:3em;">
                  </div>
                </td>
                <td class="text-center">
                  <div class="form-inline justify-content-center">
                    <input class="form-control text-end" type="text" name="enter_qty[]" value="1" maxlength="5" style="width:4em;">
                  </div>
                </td>
                            </tr>
              <tr>
                <td class="text-center"><input type="checkbox" name="entity[]" value="sto_dialyser" checked=""></td>
                <td class="text-center">투석기</td>
                <td class="text-center">
                  X20                  <input type="hidden" name="pdt_code[]" value="X20">
                </td>
                <td class="text-start">Xevonta 20</td>
                              <td class="text-center">
                  <div class="form-inline justify-content-center">
                    <input class="form-control text-end" type="text" name="qty[]" value="80" maxlength="5" style="width:4em;">
                  </div>
                </td>
                <td class="text-center">개</td>
                <td class="text-center">
                  <div class="form-inline justify-content-center">
                    <input class="form-control text-end" type="text" name="box_qty[]" value="1" maxlength="5" style="width:3em;">
                  </div>
                </td>
                <td class="text-center">
                  <div class="form-inline justify-content-center">
                    <input class="form-control text-end" type="text" name="enter_qty[]" value="1" maxlength="5" style="width:4em;">
                  </div>
                </td>
                            </tr>
              <tr>
                <td class="text-center"><input type="checkbox" name="entity[]" value="sto_bloodline" checked=""></td>
                <td class="text-center">Bloodline</td>
                <td class="text-center">
                  DLG                  <input type="hidden" name="pdt_code[]" value="DLG">
                </td>
                <td class="text-start">AV set DLG</td>
                              <td class="text-center">
                  <div class="form-inline justify-content-center">
                    <input class="form-control text-end" type="text" name="qty[]" value="360" maxlength="5" style="width:4em;">
                  </div>
                </td>
                <td class="text-center">개</td>
                <td class="text-center">
                  <div class="form-inline justify-content-center">
                    <input class="form-control text-end" type="text" name="box_qty[]" value="1" maxlength="5" style="width:3em;">
                  </div>
                </td>
                <td class="text-center">
                  <div class="form-inline justify-content-center">
                    <input class="form-control text-end" type="text" name="enter_qty[]" value="1" maxlength="5" style="width:4em;">
                  </div>
                </td>
                            </tr>
              <tr>
                <td class="text-center"><input type="checkbox" name="entity[]" value="" disabled=""></td>
                <td class="text-center">기타</td>
                <td class="text-center">
                  16G                  <input type="hidden" name="pdt_code[]" value="16G">
                </td>
                <td class="text-start">AVF needle 16G</td>
                              <td class="text-end">2400</td>
                <td class="text-center">개</td>
                <td class="text-center"></td>
                <td class="text-start"></td>
                            </tr>
              <tr>
                <td class="text-center"><input type="checkbox" name="entity[]" value="" disabled=""></td>
                <td class="text-center">기타</td>
                <td class="text-center">
                  17G                  <input type="hidden" name="pdt_code[]" value="17G">
                </td>
                <td class="text-start">AVF needle 17G</td>
                              <td class="text-end">600</td>
                <td class="text-center">개</td>
                <td class="text-center"></td>
                <td class="text-start"></td>
                            </tr>
            </tbody>
          </table>
        </div>
      </div>
      
      <div class="modal-footer">
        <button class="btn btn-primary save-btn px-3" type="submit">입고 완료</button>
      </div>
      
      <input type="hidden" name="act" value="enter">
      <input type="hidden" name="id" value="32">
      </form>

<script>
$(document).ready(function() {
  /*
  $("#modal-db-form").on("submit", function(e) {
    e.preventDefault();
    
    $.post("/phpinfo", $("#modal-db-form").serialize(), function(response) {
      if (response.result) {
        $(location).attr("href", $(".list-btn").attr("href"));
      } else {
        alert(response.message);
      }
    }, "json").fail(function(xhr) {
      toastr.error(xhr.responseText);
      console.log(xhr);
    });
  });
  */
});
</script>



    </div>
  </div>
    
    
    
  </body>
</html>
