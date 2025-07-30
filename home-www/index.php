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
        <h1 class="display-4 mb-4 text-white">
          세상을 조금 더<br>
          효율적으로 만듭니다
        </h1>
        <button class="btn btn-header contact-btn">CONTACT</button>
      </div>
    </div>
  </header>
  
  <section class="text-center">
    <div class="container">
      <h2 class="mb-2">
        <div class="text-title-block">
          <span class="text-title-span">데이터퍼스트는 기업의</span>
          <span class="text-title-span">생산성 향상을 위한</span>
        </div>
        <div class="text-title-block">
          <span class="text-title-span">데이터 수집, 처리, 분석</span>
          <span class="text-title-span">등의 기술을 제공합니다.</span>
        </div>
      </h2>
      <div class="row">
        <div class="col-md-4">
          <div class="card my-3">
            <div class="card-body bg-light">
              <i class="fas fa-globe fa-5x fa-fw mt-3"></i>
              <p class="mt-3">
                인터넷을 이용해서<br>
                업무를 효율적이고<br>
                명확하게<br>
                처리하고 싶은가요?<br>
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card my-3">
            <div class="card-body bg-light">
              <i class="fas fa-chart-line fa-5x fa-fw mt-3"></i>
              <p class="mt-3">
                각종 데이터를<br>
                수집하고 활용해서<br>
                의사 결정을 할 때<br>
                참고하고 싶은가요?<br>
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card my-3">
            <div class="card-body bg-light">
              <i class="fas fa-cogs fa-5x fa-fw mt-3"></i>
              <p class="mt-3">
                현재 사용중인<br>
                CS 프로그램 혹은<br>
                EXCEL을 웹으로<br>
                전환하고 싶은가요?<br>
              </p>
            </div>
          </div>
        </div>
      </div>
      <h2 class="mt-3">
        <div class="text-title-block"><span class="text-title-span">그렇다면</span> <span class="text-title-span">데이터퍼스트에</span> <span class="text-title-span">문의해 보세요~</span></div>
      </h2>
    </div>
  </section>
  
  <section>
    <div class="container">
      <div class="mb-3">데이터퍼스트를 이용하면</div>
      <ul class="list-unstyled">
        <li class="d-flex single-item">
          <div class="flex-shrink-0 single-icon"><i class="fas fa-retweet fa-fw"></i></div>
          <div class="flex-grow-1 ms-2">
            반복적인 작업을 다양한 방법으로 단순화/체계화/자동화 하여 생산성을 향상 합니다.
          </div>
        </li>
        <li class="d-flex single-item">
          <div class="flex-shrink-0 single-icon"><i class="fas fa-list-ul fa-fw"></i></div>
          <div class="flex-grow-1 ms-2">
            각종 장비, 센스, 유저 행동 등의 실시간 데이터를 아마존 Kinesis 서비스로 수집 합니다.
          </div>
        </li>
        <li class="d-flex single-item">
          <div class="flex-shrink-0 single-icon"><i class="fas fa-chart-pie fa-fw"></i></div>
          <div class="flex-grow-1 ms-2">
            수집된 데이터를 아마존 API Gateway, Lambda 등을 이용해 데이터를 분석/처리 합니다.
          </div>
        </li>
        <li class="d-flex single-item">
          <div class="flex-shrink-0 single-icon"><i class="fab fa-aws fa-fw"></i></div>
          <div class="flex-grow-1 ms-2">
            아마존 웹 서비스를 이용해 365일 빠르고 안정적인 인터넷 환경이 지원됩니다.
          </div>
        </li>
      </ul>
    </div>
  </section>
  
  <section class="text-center">
    <div class="container">
      <div class="text-title-block">
        <span class="text-title-span"><i class="fas fa-quote-left fa-1x mx-1"></i> 세상은 저절로</span> <span class="text-title-span">좋아지지 않습니다 <i class="fas fa-quote-right fa-1x mx-1"></i></span>
        <span class="text-title-span">— 에릭 홉스봄</span>
      </div>
      <div class="my-4 quote-img">
        <img class="rounded-circle" src="/assets/eric.png" alt="에릭 홉스봄" style="width:100px;">
      </div>
      <div class="text-title-block">
        <span class="text-title-span">세상의 대부분 일은 애정을 가지면</span>
        <span class="text-title-span">어떻게든 더 잘할 수 있습니다.</span>
      </div>
      <div class="text-title-block">
        <span class="text-title-span">어제보다 조금 더 좋게 만들 수</span>
        <span class="text-title-span">있는 방법은 무엇인지 늘 고민하고</span>
      </div>
      <div class="text-title-block">
        <span class="text-title-span">이렇게도 해 보고 저렇게도 해 보면서</span>
        <span class="text-title-span">끊임없이 새로운 시도를 한다면</span>
      </div>
      <div class="text-title-block">
        <span class="text-title-span">세상을 조금 더 효율적이고</span>
        <span class="text-title-span">좋아지게 만들 수 있습니다.</span>
      </div>
    </div>
  </section>

<?
	include "./footer.inc.php";
?>
