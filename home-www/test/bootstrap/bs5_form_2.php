<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no,user-scalable=no">
    <title>KL데모내과</title>
    <link rel="shortcut icon" href="/upload/11111111/favicon-16x16.png" type="image/png">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,700|Raleway:400,700|Noto+Sans+KR:400,700">
    <link rel="stylesheet" href="/bower/bootstrap/dist/css/bootstrap.min.css?v=5.3.7">
    <link rel="stylesheet" href="/bower/fontawesome-pro/css/all.min.css?v=5.15.4">
    <link rel="stylesheet" href="/bower/fullcalendar/dist/fullcalendar.min.css?v=3.10.2">
    <link rel="stylesheet" href="/bower/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css?v=1.10.0">
    <link rel="stylesheet" href="/bower/toastr/toastr.min.css?v=2.1.3">
    <link rel="stylesheet" href="/custom/style.css?mtime=20210722150703">
    <script src="/bower/jquery/dist/jquery.min.js?v=3.7.1"></script>
    <!-- PWA -->
    <link rel="manifest" href="/manifest.json">
    <link rel="apple-touch-icon" href="/upload/11111111/favicon-192x192.png">
  </head>
  
  <body>

    <ul class="content-entries" data-params='{"find_hd_date": "<?= $find_hd_date ?>", "selected_tab": "<?= $selected_tab ?>", "filter": "<?= $filter ?>", "page": 1}'>
      <li class="entry">


<div class="dropdown-col">
      <div class="mb-1">
        <span class="dropdown-title">간호사 로그인 필요</span>
      </div>
      
      <form class="sch-auth-nurse-id-confirm" method="post" role="form">
      <div class="mb-1">
        <div class="input-group" style="width:220px">
          <select class="form-select" name="nurse_id">
            <option value="" selected="">선택</option>
                      <option value="1">문소리 간호사</option>
                      <option value="2">김수지 간호사</option>
                      <option value="3">김태리 간호사</option>
                      <option value="4">황신예 간호사</option>
                      <option value="10">오인혜 간호사</option>
                      <option value="5">송혜교 간호사</option>
                      <option value="6">손예진 간호사</option>
                      <option value="7">이민정 간호사</option>
                    </select>
          <input class="form-control" type="password" name="auth_password" value="">
          
          <input type="hidden" name="act" value="confirm_after_auth">
          <input type="hidden" name="entity" value="sch_dialysate_b">
          <input type="hidden" name="attribute" value="nurse_id">
          <input type="hidden" name="sch_id" value="92113">
          <input type="hidden" name="num" value="1">
          <input type="hidden" name="auth_type" value="password">
          
          <button type="submit" class="btn btn-default btn-flat">확인</button>
        </div>
      </div>
      </form>
      
    </div>
    
    </li>
    </ul>

<script>
    
$(document).ready(function() {
    
    
  $(".content-entries").on("submit", ".sch-auth-nurse-id-confirm", function(e) {
    e.preventDefault();
    
    if ($(this).find(":input[name='nurse_id']").val() == "") {
      alert("간호사를 선택하여 주십시오");
      $(this).find(":input[name='nurse_id']").focus();
      return;
    }
    
    if ($(this).find(":input[name='auth_password']").val() == "") {
      alert("패스워드를 입력하여 주십시오");
      $(this).find(":input[name='auth_password']").focus();
      return;
    }
    
    var selected_sch_id = $(this).find(":input[name='sch_id']").val();
    $.post("/models/sch_auth.php", $(this).serialize(), function(response) {
      if (response.result) {
        if (response.entity == "sch_pat_all") {
          $(".sch-entry-refresh-btn[data-sch-id=" + selected_sch_id + "]").trigger("click");
        } else {
          updateNurseAuthedBadgeElement(response);
        }
      } else {
        alert(response.message);
      }
    }, "json").fail(function(xhr) {
      toastr.error(xhr.responseText);
      console.log(xhr);
    });
  });
  
});

</script>
  
    
    
  </body>
</html>
