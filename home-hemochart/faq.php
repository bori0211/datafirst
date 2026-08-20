<?
	// REQUIRE FILES (필수)
	require "./config.inc.php";
	require "./set_init_data.inc.php";
	
	$selected_menu = "faq";
	
	
	
	include "./header.inc.php";
?>

  <header id="faq-background-image">
    <div class="header-backdrop">
      <div class="header-overlay">
        <h1 class="display-4 mb-4 text-white">
          <span class="text-title-span">환자에게만</span> 집중할 수 있게<br>
          <span class="text-title-span">최선을 다</span> <span class="text-title-span">하겠습니다</span>
        </h1>
        <button class="btn btn-header contact-btn">CONTACT</button>
      </div>
    </div>
  </header>
  
  <section class="faq">
    <div class="container">
      
      <h4 class="faq-title">일반 사항</h4>
      <ul>
        <li id="faq-general-1">
          <div class="faq-question"><a href="#faq-general-1">1. 프로그램을 사용하면 이전 종이에 기록된 의료 정보를 보고 싶을 땐 어떻게 하나요?</a></div>
          <div class="faq-answer">
            <p>이전 종이에 기록된 투석기록지의 내용은 제한적으로 업로드 할 수 있습니다.</p>
            <p>예를 들어 투석환자 월검사기록, 투석환자의 처방(EPO, 주사제, 경구약, 처치 등)은 과거 기록을 업로드 할 수 있습니다.<br>
            통상의 경우 혈액검사기관(씨젠, 녹십자, 삼광 등)에서 제공하는 검사결과가 검사기관의 홈페이지에서 원하는 기간별로 다운 받을 수 있고,<br>
            투석환자 처방의 경우도 청구프로그램(의사랑 등)에서 제공하므로 다운받아 업로드 할 수 있습니다.</p>
            <p>더불어 종이에 기록된 투석환자 정보 중 장기간 보관이 필요한 정보의 경우 해당 정보를 스캔하여 해당 환자의 페이지에 저장할 수 있습니다.</p>
          </div>
        </li>
      </ul>
      <ul>
        <li id="faq-general-2">
          <div class="faq-question"><a href="#faq-general-2">2. 집에서 환자정보를 확인하고 입력할 수 있나요?</a></div>
          <div class="faq-answer">
            <p>원장님의 경우 퇴근 후에 환자의 정보를 확인해야 할 경우가 발생하곤 합니다.</p>
            <p>가능합니다. 집 컴퓨터에서도 접속이 가능 합니다.<br>관리자의 자격으로 로그인 하여 집에서 확인되는 IP주소를 등록하면 프로그램을 병원에서 처럼 사용이 가능 합니다.</p>
            <p>HEMOCHART는 지역적, 시간적 제한이 없이 인터넷이 가능한 국내외 모든 곳에서 접속이 가능하므로<br> 해외학회 참석, 병원 외 지역 출장, 여행 등의 상황에서도 사용이 가능 합니다.</p>
            <p>HEMOCHART는 인터넷 기반 서비스 이므로 PC 뿐만 아니라, 태블릿 피씨, 스마트폰에서도 접속이 가능 합니다.</p>
            <p>단, 대면진료가 아닌 상황에서 직접적인 의료행위는 의료법에서 허용되지 않는 다는 사실을 염두하여 주시기 바랍니다.</p>
          </div>
        </li>
      </ul>
      <ul>
        <li id="faq-general-3">
          <div class="faq-question"><a href="#faq-general-3">3. 보험청구도 연동 되나요?</a></div>
          <div class="faq-answer">
            <p>청구를 직접하거나 청구프로그램과 연동되지는 않습니다.</p>
            <p>보험청구는 투석환자들 뿐만 아니라 일반 외래진료와 건강검진 등이 복합적으로 처리되어야 하기 때문에<br> 연동되어 있지 않습니다. HEMOCHART는 신장실 운영 위주로 개발된 프로그램입니다.</p>
          </div>
        </li>
      </ul>
      
      <h4 class="faq-title">설치 관련</h4>
      <ul>
        <li id="faq-install-1">
          <div class="faq-question"><a href="#faq-install-1">1. HemoChart를 사용하려면 별도의 프로그램을 설치해야 하나요?</a></div>
          <div class="faq-answer">
            HemoChart는 웹 기반의 프로그램 입니다. 그렇기 때문에 별도의 프로그램을 설치를 하지 않아도 됩니다.<br>
            웹브라우저만 있으면 모든 걸 사용할 수 있고 프로그램 설치, 데이터 백업과 같은 번거로운 일을 하지 않아도 되기 때문에<br>
            병원 본연의 일에 집중할 수 있습니다.
          </div>
        </li>
        <li id="faq-install-2">
          <div class="faq-question"><a href="#faq-install-2">2. HemoChart를 사용하려면 절차가 어떻게 되나요?</a></div>
          <div class="faq-answer">
            <p>1. 문의 ...</p>
            <p>2. 계약 ...</p>
            <p>3. 설치 ...</p>
          </div>
        </li>
        <li id="faq-install-3">
          <div class="faq-question"><a href="#faq-install-3">3. HemoChart를 사용하면 어떤 장점이 있나요?</a></div>
          <div class="faq-answer">
            <p>1. 백업 걱정 X (아마존 클라우드 서비스의 사용으로 세상에서 가장 안전하게 데이터를 보관)</p>
            <p>2. 랜섬웨어 걱정 X (2020년 11월 E-Land 랜섬웨어 공격에 따른 피해) (<a class="text-primary" href="https://www.chosun.com/economy/economy_general/2020/11/22/SGP6PBI5PJA5PGQ5SF2THXMFRQ/" target="_blank"><i class="fas fa-external-link-alt fa-fw"></i> 조선일보 기사</a>)</p>
            <p>3. (데이터는 21세기 원유라고 불릴만큼 중요, 로컬 병원에서 데이터 관리에 한계가 있음)</p>
          </div>
        </li>
      </ul>
      
      <h4 class="faq-title pt-4">보안 관련</h4>
      <ul>
        <li id="faq-secure-1">
          <div class="faq-question"><a href="#faq-secure-1">1. 의료 정보인데 웹기반의 프로그램을 사용해도 괜찮은가요?</a></div>
          <div class="faq-answer">
            <img class="img-fluid" src="/assets/faq/press_20171201.jpg"><br>
            <p class="ms-1 mt-2">과학기술 정보통신부 -「클라우드 컴퓨팅 주요 법령 해설서」 요약문 중 “의료 분야”</p>
            <p class="ms-1 mt-2"><a class="text-primary" href="/assets/faq/press_20171201.pdf" target="_blank">「클라우드 컴퓨팅 주요 법령 해설서」 보도 자료 전문 - PDF 파일로 보기</a></p>
          </div>
        </li>
      </ul>
      
    </div>
  </section>

<?
	include "./footer.inc.php";
?>
