<!DOCTYPE html>

<html data-bs-theme="light">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no,user-scalable=no">
    <title>DataFirst</title>
    <link rel="shortcut icon" href="/assets/favicon-16x16.png" type="image/png">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,700|Raleway:400,700|Noto+Sans+KR:400,700">
    <link rel="stylesheet" href="/bower/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/bower/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/custom/style.css">
    <script src="/bower/jquery/dist/jquery.min.js"></script>
    <!-- PWA -->
    <link rel="manifest" href="/manifest.json">
    <link rel="apple-touch-icon" href="/assets/favicon-192x192.png">
  </head>
  
  <body>
    <nav class="navbar fixed-top navbar-expand-md">
      <div class="container">
        <div class="navbar-logo">
          <a class="navbar-brand" href="/"><img class="logo-img" src="/assets/logo_datafirst.png"></a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-collapse">
          <i class="fas fa-bars fa-fw" id="navbar-toggler-icon"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link <? if ($selected_menu == 'home') echo 'selected'; ?>" href="/">HOME</a></li>
            <li class="nav-item"><a class="nav-link <? if ($selected_menu == 'hemo') echo 'selected'; ?>" href="/hemo">혈액 투석 차트</a></li>
            <li class="nav-item"><a class="nav-link <? if ($selected_menu == 'websign') echo 'selected'; ?>" href="/websign">WEB SIGN</a></li>
            <li class="nav-item"><a class="nav-link contact-btn" href="#">CONTACT</a></li>
          </ul>
        </div>
      </div>
    </nav>
    