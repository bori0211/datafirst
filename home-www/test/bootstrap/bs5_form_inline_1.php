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


      <form class="form-inline" role="form" id="content-search-form">
        <select class="form-select" name="search">
          <option value="">선택</option>
          <option value="cht_num" <? if ($search == "cht_num") echo "selected"; ?>>차트 번호</option>
          <option value="insurance_type" <? if ($search == "insurance_type") echo "selected"; ?>>보험 형태</option>
          <option value="name" <? if ($search == "name") echo "selected"; ?>>환자명</option>
          <option value="ssn" <? if ($search == "ssn") echo "selected"; ?>>주민번호</option>
          <option value="hp_no" <? if ($search == "hp_no") echo "selected"; ?>>휴대폰</option>
          <option value="contact" <? if ($search == "contact") echo "selected"; ?>>비상 연락처</option>
        </select>
        <input class="form-control ms-1" type="text" name="find" value="<?= $find ?>">
        <input type="hidden" name="page" value="1">
        <button class="btn btn-default ms-1" type="submit">검색</button>
        <a class="btn btn-default ms-1" href="/excel/pat_regular.php?<?= $search_request ?>">엑셀</a>
      </form>


<br><br><br>


<form class="row">
  <div class="col-12">
    <label class="mx-2" for="inlineFormSelectPref">Preference</label>
    <input class="form-control" type="text" name="unit" value="<?= $unit ?>" maxlength="40" style="width:20em;">
  </div>
</form>

<br>
<br>
  
<form class="row row-cols-lg-auto g-3 align-items-center">
  <div class="col-12">
    <label class="visually-hidden" for="inlineFormInputGroupUsername">Username</label>
    <div class="input-group">
      <div class="input-group-text">@</div>
      <input type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="Username">
    </div>
  </div>

  <div class="col-12">
    <label class="mx-2" for="inlineFormSelectPref">Preference</label>
    <select class="form-select" id="inlineFormSelectPref">
      <option selected>Choose...</option>
      <option value="1">One</option>
      <option value="2">Two</option>
      <option value="3">Three</option>
    </select>
  </div>

  <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="inlineFormCheck">
      <label class="form-check-label" for="inlineFormCheck">
        Remember me 7
      </label>
    </div>
  </div>

  <div class="col-12">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>

    
  </body>
</html>
