<?
	// REQUIRE FILES (필수)
	require "./config.inc.php";
	require "./set_init_data.inc.php";
	
	$selected_menu = "catalog";
	
	
	
	include "./header.inc.php";
?>

  <header id="catalog-background-image">
    <div class="header-backdrop">
      <div class="header-overlay">
        <h1 class="display-4 mb-4 text-white">
          <span class="text-title-span">HemoChart는</span> 실제 투석실의<br>
          <span class="text-title-span">필요에 의해</span> <span class="text-title-span">만들어졌습니다</span>
        </h1>
        <button class="btn btn-header contact-btn">CONTACT</button>
      </div>
    </div>
  </header>
  
  <section class="catelog text-center">
    <div class="container">
      
      <div class="text-center mb-4">
        <a href="/assets/catalog/catalog_20200612.pdf" class="btn btn-danger btn-lg px-4" target="_blank">PDF 파일로 보기 (2020.6.12 version)</a>
      </div>
      
      <div id="catalog-carousel" class="carousel slide" style="border: 1px solid #000;">
        <div class="carousel-inner">
          <div class="carousel-item active"><img class="d-block catalog-page" src="/assets/catalog/0.jpg"></div>
          <div class="carousel-item"><img class="d-block catalog-page" src="/assets/catalog/1.jpg"></div>
          <div class="carousel-item"><img class="d-block catalog-page" src="/assets/catalog/2.jpg"></div>
          <div class="carousel-item"><img class="d-block catalog-page" src="/assets/catalog/3.jpg"></div>
          <div class="carousel-item"><img class="d-block catalog-page" src="/assets/catalog/4.jpg"></div>
          <div class="carousel-item"><img class="d-block catalog-page" src="/assets/catalog/5.jpg"></div>
          <div class="carousel-item"><img class="d-block catalog-page" src="/assets/catalog/6.jpg"></div>
          <div class="carousel-item"><img class="d-block catalog-page" src="/assets/catalog/7.jpg"></div>
          <div class="carousel-item"><img class="d-block catalog-page" src="/assets/catalog/8.jpg"></div>
          <div class="carousel-item"><img class="d-block catalog-page" src="/assets/catalog/9.jpg"></div>
          <div class="carousel-item"><img class="d-block catalog-page" src="/assets/catalog/10.jpg"></div>
          <div class="carousel-item"><img class="d-block catalog-page" src="/assets/catalog/11.jpg"></div>
          <div class="carousel-item"><img class="d-block catalog-page" src="/assets/catalog/12.jpg"></div>
          <div class="carousel-item"><img class="d-block catalog-page" src="/assets/catalog/13.jpg"></div>
          <div class="carousel-item"><img class="d-block catalog-page" src="/assets/catalog/14.jpg"></div>
          <div class="carousel-item"><img class="d-block catalog-page" src="/assets/catalog/15.jpg"></div>
          <div class="carousel-item"><img class="d-block catalog-page" src="/assets/catalog/16.jpg"></div>
          <div class="carousel-item"><img class="d-block catalog-page" src="/assets/catalog/17.jpg"></div>
          <div class="carousel-item"><img class="d-block catalog-page" src="/assets/catalog/18.jpg"></div>
          <div class="carousel-item"><img class="d-block catalog-page" src="/assets/catalog/19.jpg"></div>
        </div>
        
        <a class="carousel-control-prev d-none d-md-flex" href="#catalog-carousel" role="button" data-bs-slide="prev">
          <i class="fas fa-angle-left fa-fw"></i>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next d-none d-md-flex" href="#catalog-carousel" role="button" data-bs-slide="next">
          <i class="fas fa-angle-right fa-fw"></i>
          <span class="sr-only">Next</span>
        </a>
        
        <ol class="carousel-indicators">
          <li data-bs-target="#catalog-carousel" data-bs-slide-to="0" class="active"></li>
          <li data-bs-target="#catalog-carousel" data-bs-slide-to="1"></li>
          <li data-bs-target="#catalog-carousel" data-bs-slide-to="2"></li>
          <li data-bs-target="#catalog-carousel" data-bs-slide-to="3"></li>
          <li data-bs-target="#catalog-carousel" data-bs-slide-to="4"></li>
          <li data-bs-target="#catalog-carousel" data-bs-slide-to="5"></li>
          <li data-bs-target="#catalog-carousel" data-bs-slide-to="6"></li>
          <li data-bs-target="#catalog-carousel" data-bs-slide-to="7"></li>
          <li data-bs-target="#catalog-carousel" data-bs-slide-to="8"></li>
          <li data-bs-target="#catalog-carousel" data-bs-slide-to="9"></li>
          <li data-bs-target="#catalog-carousel" data-bs-slide-to="10"></li>
          <li data-bs-target="#catalog-carousel" data-bs-slide-to="11"></li>
          <li data-bs-target="#catalog-carousel" data-bs-slide-to="12"></li>
          <li data-bs-target="#catalog-carousel" data-bs-slide-to="13"></li>
          <li data-bs-target="#catalog-carousel" data-bs-slide-to="14"></li>
          <li data-bs-target="#catalog-carousel" data-bs-slide-to="15"></li>
          <li data-bs-target="#catalog-carousel" data-bs-slide-to="16"></li>
          <li data-bs-target="#catalog-carousel" data-bs-slide-to="17"></li>
          <li data-bs-target="#catalog-carousel" data-bs-slide-to="18"></li>
          <li data-bs-target="#catalog-carousel" data-bs-slide-to="19"></li>
        </ol>
      </div>
    </div>
  </section>

<script>
$(document).ready(function() {
  $("#catalog-carousel").carousel({
    interval: 5000,
    wrap: true,
    pause: "hover",
    ride: "carousel"
  });
});
</script>

<?
	include "./footer.inc.php";
?>
