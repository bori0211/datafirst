<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no,user-scalable=no">
    <title>DataFirst</title>
    <link rel="shortcut icon" href="/assets/favicon-16x16.png" type="image/png">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,700|Raleway:400,700|Noto+Sans+KR:400,700">
    <link rel="stylesheet" href="/bower/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/bower/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/custom/style.css">
    <script src="/bower/jquery/dist/jquery.min.js"></script>
    <!-- PWA -->
    <link rel="manifest" href="/manifest.json">
    <link rel="apple-touch-icon" href="/assets/favicon-192x192.png">
  </head>
  
  <body>
  
  <header id="index-background-image">
    <div class="header-backdrop">
      <div class="header-overlay">
        <h1 class="display-4 mb-4 text-white">
          세상을 조금 더<br>
          효율적으로 만듭니다         </h1>
        <button class="btn btn-header contact-btn">CONTACT</button>
      </div>
    </div>
  </header>
    
    
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contact-form-modal">
  Launch demo modal
</button>
    
    
    
    <div class="modal fade" id="contact-form-modal" role="dialog" tabindex="0">
    
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
</div>    
    
    </div>
    
    <script src="/bower/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!--<script src="/custom/app.js"></script>-->
    
    
<script>
$(document).ready(function() {
  console.log("1234");
  
  
  // modal
  $(".contact-btn").on("click", function (e) {
    console.log("contact-btn");
    e.preventDefault();
    
var myModal = new bootstrap.Modal(document.getElementById('contact-form-modal'), {
  keyboard: false
})    

myModal.show()



    /*
    $("#contact-form-modal").load("/modals/contact_form.php", function (result) {
      console.log(result);
      
      var myModalEl = document.getElementById('contact-form-modal');
      console.log(myModalEl);
      var modal = new bootstrap.Modal(myModalEl);
      console.log(modal);
    });
    */
  });
  
  
});
</script>    
    
  </body>
</html>
