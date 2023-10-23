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
          효율적으로 만듭니다 2         </h1>
        <button class="btn btn-header contact-btn">CONTACT</button>
      </div>
    </div>
  </header>
    

<div class="first">    
	<span class="badge badge-default" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-html="true" title="<div class='text-start'>구분: 투석액A<br/>이름: 보령헤모시스지액<br/></div>">
	  123
	</span>
	
	<span class="badge badge-default" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-html="true" title="<div class='text-start'>구분: 투석액B<br/>이름: 보령헤모시스지액<br/></div>">
	  456
	</span>
</div>

<div class="second">    
	<span class="badge badge-default" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-html="true" title="<div class='text-start'>구분: 투석액A<br/>이름: 보령헤모시스지액<br/></div>">
	  789
	</span>
	
	<span class="badge badge-default" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-html="true" title="<div class='text-start'>구분: 투석액B<br/>이름: 보령헤모시스지액<br/></div>">
	  100
	</span>
</div>
                    
                    
                        
    <script src="/bower/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!--<script src="/custom/app.js"></script>-->
    
    
<script>
$(document).ready(function() {
  console.log("1234");
  
  /*
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})

  */
  
    var tooltipEntries = $(".first").find('[data-bs-toggle="tooltip"]');
    
    console.log(tooltipEntries);
    
    $.each(tooltipEntries, function(index, element) {
      console.log(element);
      
      var tooltip = new bootstrap.Tooltip(element, {})
      
      //$(dropdownEntries).append(element.entry);
    });
    
    
    /*
    $(dropdownEntries).html("<li class='entry'><div class='mx-auto' style='line-height:19px;'><i class='fas fa-spinner fa-spin mx-auto'></i></div></li>");
    $.get("/parts/entries/sch_doctor_order.php", $(this).data("params"), function(response) {
      $(dropdownEntries).empty();
      $.each(response.entries, function(index, element) {
        $(dropdownEntries).append(element.entry);
      });
    }, "json").fail(function(xhr) {
      toastr.error(xhr.responseText);
      console.log(xhr);
    });
    */
  
  
  
});
</script>    
    
  </body>
</html>
