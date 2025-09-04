<?
	// REQUIRE FILES (필수)
	require "./config.inc.php";
	require "./set_init_data.inc.php";
	
	$selected_menu = "kidneylife";
	
	
	
	include "./header.inc.php";
?>

  <header id="kidneylife-background-image">
    <div class="header-backdrop">
      <div class="header-overlay">
        <img class="img-fluid" src="/assets/all_in_one_hand.png">
        <button class="btn btn-header contact-btn">CONTACT</button>
      </div>
    </div>
  </header>
  
  <section>
    <div class="container">
      <!--<h3 class="section-title mb-3 ms-2"><i class="fas fa-fire-alt fa-fw"></i> KidneyLife</h3>-->
      <div class="row">
        <div class="col-md-6">
          <p>
            헬스케어 분야에서<br>
            환자와 의료진, 의료 서비스 산업 종사자, 보건 행정 당국 사이에<br>
            폭 넓은 정보 교류가 점점 늘어가는 것은 시대의 흐름입니다.
          </p>
          
          <p>
            이는 투석실을 운영하는 신장내과 분야에서도 크게 다르지 않아,<br>
            하루에도 많은 양의 다양하고 복잡한 의료 데이터가 생성되고<br>
            있습니다.
          </p>
          
          <p>
            키드니라이프는<br>
            최신의 IT기술을 이용하여 획기적인 투석실 정보처리 솔루션인<br>
            HemoChart 프로그램을 개발하였습니다.
          </p>
          
          <p>
            투석실에서 요구되는 다양한 의료정보의 효율적인 관리와<br>
            최적의 정보처리 기능을 제공합니다.
          </p>
        </div>
        
        <div class="col-md-6 d-none d-md-block">
          <img class="img-fluid" src="/assets/kidneylife/hemochart_intro.png">
        </div>
      </div>
    </div>
  </section>

<?
	include "./footer.inc.php";
?>
