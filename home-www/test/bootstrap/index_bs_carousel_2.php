<?
	// REQUIRE FILES (필수)
	require "../config.inc.php";
	require "../set_init_data.inc.php";
	require "../function.inc.php";
	
	// MYSQLi INSTANCE
	$mysqli = mysqli_instance();
	
	// HEADER INCLUDE
	include "../header.inc.php";
?>

<style>
body {
  background-color: #fff;
}
</style>

<div class="container" style="width:400px">
<div id="carouselExampleCaptions" class="carousel slide">
  <div class="carousel-inner">
    <div class="carousel-item active" data-params='{"selectdItem": 4}'>
      <img src="https://img.webframe.io/cover-img/clt/resize/100001/0011_20230529104502.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item" data-params='{"selectdItem": 5}'>
      <img src="https://img.webframe.io/cover-img/clt/resize/100001/0012_20230529104509.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>Some representative placeholder content for the second slide.</p>
      </div>
    </div>
    <div class="carousel-item" data-params='{"selectdItem": 6}'>
      <img src="https://img.webframe.io/cover-img/clt/resize/100001/0005_20230529104438.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Third slide label</h5>
        <p>Some representative placeholder content for the third slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
  <div class="carousel-indicators">
    <button type="button" class="prev-page-btn">PrevPage</button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
</div>
</div>

<script>
$(document).ready(function() {
  
  $("#carouselExampleCaptions").carousel({
    interval: false,
    wrap: false,
    pause: "hover",
    ride: false
  });
  
  $("#carouselExampleCaptions").on("mousewheel", function(e) {
    //console.log($(this));
    //console.log($(this).find(".carousel-inner .carousel-item.active").data("params").selectdItem);
    var firstItem = 4;
    var currentItem = $(this).find(".carousel-inner .carousel-item.active").data("params").selectdItem;
    //console.log("lastItem: " + lastItem);
    //console.log("currentItem: " + currentItem);
    
    if (e.originalEvent.wheelDelta / 120 > 0) {
      if (firstItem == currentItem)
        $(this).find(".carousel-indicators .prev-page-btn").trigger("click");
      else
        $(this).carousel("prev");
    } else {
      $(this).carousel("next");
    }
  });
  
  // Fired when the carousel has completed its slide transition.
  $("#fullpage-carousel").on("slid.bs.carousel", function(e) {
  });
  
  // nav link
  $("#carouselExampleCaptions .carousel-indicators").on("click", ".prev-page-btn", function(e) {
    e.preventDefault();
    $(location).attr("href", "./index_bs_carousel_1.php");
  });
  
});
</script>

<?
	// FOOTER INCLUDE
	include "../footer.inc.php";
	
	// MYSQLi CLOSE
	$mysqli->close();
?>
