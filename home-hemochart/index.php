<?
	// REQUIRE FILES (필수)
	require "./config.inc.php";
	require "./set_init_data.inc.php";
	
	$selected_menu = "home";
	
	
	
	include "./header.inc.php";
?>

  <header id="index-background-image">
    <div class="header-backdrop">
      <div class="header-overlay">
        <img class="img-fluid" src="/assets/all_in_one_hand.png">
        <button class="btn btn-header contact-btn">CONTACT</button>
      </div>
    </div>
  </header>
  
  <section class="text-center">
    <div class="container">
      <h2 class="mb-2">
        <div class="text-title-block">
          <span class="text-title-span">HemoChart는</span> <span class="text-title-span">혈액 투석실에서</span>
          <span class="text-title-span">요구되는 모든 일들을</span>
        </div>
        <div class="text-title-block">
          <span class="text-title-span">한 손에서 처리할 수</span>
          <span class="text-title-span">있는 완전 관리형</span> <span class="text-title-span">프로그램 입니다.</span>
        </div>
      </h2>
      <div class="row">
        <div class="col-md-4">
          <div class="card my-3">
            <div class="card-body bg-light">
              <i class="fas fa-users fa-5x fa-fw mt-3"></i>
              <p class="mt-3">
                투석 환자의 기본 정보, <br>
                입원, 전출, 검사 결과,<br>
                예방 접종, 전원 정보 등을<br>
                쉽게 입력/조회 하고<br>
                활용하고 싶은가요?<br>
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card my-3">
            <div class="card-body bg-light">
              <i class="far fa-calendar-alt fa-5x fa-fw mt-3"></i>
              <p class="mt-3">
                투석 환자의 일정에 따라<br>
                환자를 추가/이동/삭제하고<br>
                투석액, 투석기, Bloodline,<br>
                검사 결과, 주사제 등을<br>
                처방하고 싶은가요?<br>
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card my-3">
            <div class="card-body bg-light">
              <i class="far fa-clipboard fa-5x fa-fw mt-3"></i>
              <p class="mt-3">
                매일 수기로 작성하는<br>
                Flow Sheet를 전산화하고<br>
                이전 자료를 활용하고<br>
                주요한 데이터를 차트로<br>
                시각화해서 보고 싶은가요?<br>
              </p>
            </div>
          </div>
        </div>
      </div>
      <h2 class="mt-3">
        <div class="text-title-block">
          <span class="text-title-span">그렇다면</span>
          <span class="text-title-span">HemoChart에</span>
          <span class="text-title-span">문의해 보세요~</span>
        </div>
      </h2>
    </div>
  </section>
  
  <section>
    <div class="container">
      <h3 class="section-title mb-3 ms-2"><i class="fas fa-fire-alt fa-fw"></i> HemoChart</h3>
      <ul class="list-unstyled">
        <li class="d-flex single-item">
          <div class="flex-shrink-0 single-icon"><i class="fas fa-cogs fa-fw"></i></div>
          <div class="flex-grow-1 ms-2">
            투석 환자 관리 프로그램인 HemoChart는 사무실이 아닌 실제 투석실에서 만들어진 프로그램 입니다.
          </div>
        </li>
        <li class="d-flex single-item">
          <div class="flex-shrink-0 single-icon"><i class="far fa-id-card fa-fw"></i></div>
          <div class="flex-grow-1 ms-2">
            투석 현장에서 요구되는 필요에 의하여 탄생된 프로그램으로 뛰어난 현장 적응력을 자랑합니다.
          </div>
        </li>
        <li class="d-flex single-item">
          <div class="flex-shrink-0 single-icon"><i class="far fa-calendar-alt fa-fw"></i></div>
          <div class="flex-grow-1 ms-2">
            투석 환자의 일정관리, 투석기록지 작성 및 그에 수반되는 기초정보의 충분성과 접근 용이성이 프로그램의 장점입니다.
          </div>
        </li>
        <li class="d-flex single-item">
          <div class="flex-shrink-0 single-icon"><i class="far fa-clipboard fa-fw"></i></div>
          <div class="flex-grow-1 ms-2">
            의무기록 수기 작성과 장기 보관의 어려움 뿐만 아니라 의료기록의 전달, 확인, 조회를 간편하게 할 수 있습니다.
          </div>
        </li>
        <li class="d-flex single-item">
          <div class="flex-shrink-0 single-icon"><i class="fas fa-boxes fa-fw"></i></div>
          <div class="flex-grow-1 ms-2">
            그 외에도 재고관리, 직원 근무일정 등 혈액투석실에서 수기로 작성되고 처리되던 일들을 손쉽게 해결할 수 있습니다.
          </div>
        </li>
        <li class="d-flex single-item">
          <div class="flex-shrink-0 single-icon"><i class="fas fa-bolt fa-fw"></i></div>
          <div class="flex-grow-1 ms-2">
            심평원에서 실시하는 혈액투석 적절도 평가 자료를 손쉽게 업로드 할 수 있어 하루만에 완료할 수 있습니다.
          </div>
        </li>
        
      </ul>
      <div class="text-center d-none d-md-block">
        <br>
        <!--<a href="https://demo.hemochart.com/" class="btn btn-danger btn-lg px-4" target="_blank">HemoChart 데모 신청</a>-->
        <button class="btn btn-danger btn-lg contact-btn px-4">HemoChart 데모 신청</button>
        <span class="ms-3">(로그인: 공용 / 별도 문의)</span>
      </div>
    </div>
  </section>
  
  <section>
    <div class="container">
      <h3 class="section-title ms-2"><i class="fas fa-fire-alt fa-fw"></i> Key Values</h3>
      <img class="img-fluid mt-4" src="/assets/key_values.png">
    </div>
  </section>
  
  <section>
    <div class="container">
      <h3 class="section-title ms-2"><i class="fas fa-fire-alt fa-fw"></i> Major Features</h3>
      <img class="img-fluid mt-4" src="/assets/major_features.png">
    </div>
  </section>
  
  <!--
  <section class="clients">
    <div class="container">
      <h3 class="section-title ms-2"><i class="fas fa-fire-alt fa-fw"></i> Clients</h3>
      <div class="row">
        <div class="col-md-4">
          <div class="card mt-3">
            <div class="card-body bg-white text-center">
              <img src="/assets/clients/kl_001_samsungyoon_logo.png">
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mt-3">
            <div class="card-body bg-white text-center">
              <img src="/assets/clients/kl_002_myoungin_logo.jpg">
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mt-3">
            <div class="card-body bg-white text-center">
              <img src="/assets/clients/kl_003_ssj_logo.jpg">
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body bg-white text-center">
              <img src="/assets/clients/kl_004_ssz_logo.jpg">
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body bg-white text-center">
              <img src="/assets/clients/kl_007_chung_logo.png">
            </div>
          </div>
        </div>
        <div class="col-md-4">
        </div>
      </div>
    </div>
  </section>
  -->

<?
	include "./footer.inc.php";
?>
