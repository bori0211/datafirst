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
    <link rel="stylesheet" href="/custom/style.css?mtime=20210722150703">
    <script src="/bower/jquery/dist/jquery.min.js?v=3.7.1"></script>
    <!-- PWA -->
    <link rel="manifest" href="/manifest.json">
    <link rel="apple-touch-icon" href="/upload/11111111/favicon-192x192.png">
  </head>
  
  <body>

<button type="button" class="btn btn-primary" id="liveToastBtn">Show live toast</button>

<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">

<div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">
    <img src="..." class="rounded me-2" alt="...">
    <strong class="me-auto">Bootstrap</strong>
    <small>11 mins ago</small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
    Hello, world! This is a toast message.
  </div>
</div>

</div>

    
<script>
    
$(document).ready(function() {
    
    
var toastTrigger = document.getElementById('liveToastBtn')
var toastLiveExample = document.getElementById('liveToast')
if (toastTrigger) {
  toastTrigger.addEventListener('click', function () {
    var toast = new bootstrap.Toast(toastLiveExample)

    toast.show()
  })
}  



});

</script>
    
    
    <script src="/bower/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!--<script src="/custom/app.js"></script>-->
    
  </body>
</html>
