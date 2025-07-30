<?
	// REQUIRE FILES (필수)
	require "./config.inc.php";
	require "./set_init_data.inc.php";
	
	$selected_menu = "websign";
	
	
	
	include "./header.inc.php";
?>

  <header id="websign-background-image">
    <div class="header-backdrop">
      <div class="header-overlay">
        <h1 class="display-4 mb-4 text-white">세상을 향해<br>표현해 보세요~</h1>
        <button class="btn btn-header contact-btn">CONTACT</button>
      </div>
    </div>
  </header>
  
  <section class="text-center">
    <div class="container">
      <div class="prepare">
        <div class="wait-content">
          <h1 class="message">컨텐츠 준비중 입니다~</h1>
        </div>
      </div>
    </div>
  </section>

<?
	include "./footer.inc.php";
?>
