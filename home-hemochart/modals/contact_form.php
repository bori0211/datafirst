<?
	// REQUIRE FILES (필수)
	require "../config.inc.php";
	require "../set_init_data.inc.php";
?>

  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">CONTACT</h2>
        <button class="btn btn-modal-icon" type="button" data-bs-dismiss="modal"><i class="fas fa-times fa-fw" style="font-size:16px;"></i></button>
      </div>
      
      <div class="modal-body">
        <div class="d-flex justify-content-center">
          <div class="motd">
            <div class="text-title-block" id="we-do-best-1" style="display:none;"><span class="text-title-span">투석실에서 요구되는 다양한</span> 의료 정보의 효율적인 관리와</div>
            <div class="text-title-block" id="we-do-best-2" style="display:none;"><span class="text-title-span">최적의 정보 처리 기능을 제공할</span> 수 있게 최선을 다하겠습니다</div>
          </div>
        </div>
        <div class="row px-2">
          <div class="col-lg-6 mb-3 pe-lg-2">
            <div class="card">
              <div class="card-body bg-light">
                <ul class="list-unstyled">
                  <li class="d-flex single-item">
                    <div class="flex-shrink-0 single-icon"><i class="fas fa-phone fa-fw"></i></div>
                    <div class="flex-grow-1 ms-2">
                      031-852-0848
                    </div>
                  </li>
                  <li class="d-flex single-item">
                    <div class="flex-shrink-0 single-icon"><i class="fas fa-map-marker fa-fw"></i></div>
                    <div class="flex-grow-1 ms-2">
                      경기도 의정부시 오목로 225길<br>
                      140, 성산타워 803호 <span class="text-secondary">(우 11813)</span>
                    </div>
                  </li>
                </ul>
                <!-- 지도 -->
                <div style="width:100%; height:350px;" id="map-canvas"></div>
                <!-- 지도 -->
              </div>
            </div>
          </div>
          <div class="col-lg-6 mb-3 ps-lg-2">
            <div class="card">
              <div class="card-body bg-light">
                <form method="post" role="form" id="contact-form">
                  <div class="mb-3 row">
                    <label class="col-md-3 col-form-label text-md-end">병원</label>
                    <div class="col-md-9">
                      <div class="form-inline">
                        <input type="text" class="form-control input-sm" name="hospital" value="" placeholder="예) KL데모내과" style="width:14em;">
                      </div>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-md-3 col-form-label text-md-end">지역</label>
                    <div class="col-md-9">
                      <div class="form-inline">
                        <input type="text" class="form-control input-sm" name="local" value="" placeholder="예) 서울시 마포구" style="width:14em;">
                      </div>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-md-3 col-form-label text-md-end"><span class="text-danger">*</span> 연락처</label>
                    <div class="col-md-9">
                      <div class="form-inline">
                        <input type="text" class="form-control input-sm" name="contact" value="" placeholder="예) 010-5555-8888" style="width:14em;">
                      </div>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label class="col-md-3 col-form-label text-md-end"><span class="text-danger">*</span> 내용</label>
                    <div class="col-md-9">
                      <div class="form-inline">
                        <textarea class="form-control input-sm" rows="5" name="content" style="width:14em;"></textarea>
                      </div>
                    </div>
                  </div>
                  
                  <div class="mb-3 row">
                    <label class="col-md-3 col-form-label text-md-end">개인정보<br>수집 및<br>이용 동의</label>
                    <div class="col-md-9">
                      <div class="form-inline">
                        <textarea class="form-control input-sm" rows="3" name="privacy" style="width:14em;">1. 개인정보 수집 범위 

  (주)키드니라이프(이하 회사)는 상담, 문의 등을 위해 아래와 같은 개인정보를 수집하고 있습니다.

  * 수집항목 : 
  1. 병원
  2. 지역
  3. 연락처
  4. 내용

  * 개인정보 수집 방법 : 홈페이지

2. 개인정보 수집 및 이용 목적

  회사는 수집한 개인정보를 다음의 목적을 위해 활용합니다. 

  * 문의에 대한 응답에 활용

3. 개인정보를 제공받는 자
  회사는 이용자의 개인정보를 원칙적으로 외부에 제공하지 않습니다. 다만, 아래의 경우에는 예외로 합니다.

  - 이용자들이 사전에 동의한 경우
  - 법령의 규정에 의거하거나, 수사 목적으로 법령에 정해진 절차와 방법에 따라 수사기관의 요구가 있는 경우

4. 개인정보 보유 및 이용기간
  원칙적으로 회사는 개인정보 수집 및 이용목적이 달성된 후에는 예외 없이 해당 정보를 지체 없이 파기합니다. 
  단, 아래 법령을 비롯하여 관계법령의 규정에 의하여 보존할 필요가 있는 경우 회사는 해당법령에서 정한 기간 동안 회원정보를 보관합니다. 

  표시/광고에 관한 기록 : 6개월 (전자상거래등에서의 소비자보호에 관한 법률)
  계약 또는 청약철회 등에 관한 기록 : 5년 (전자상거래등에서의 소비자보호에 관한 법률)
  대금결제 및 재화 등의 공급에 관한 기록 : 5년 (전자상거래등에서의 소비자보호에 관한 법률)
  소비자의 불만 또는 분쟁처리에 관한 기록 : 3년 (전자상거래등에서의 소비자보호에 관한 법률)
                        </textarea>
                      </div>
                    </div>
                  </div>
                  
                  <div class="mb-3 row">
                    <label class="col-md-3 col-form-label text-md-end"><!-- BLANK --></label>
                    <div class="col-md-9">
                      <div class="form-inline">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="agree" value="1" id="checkbox_agree">
                          <label class="form-check-label" for="checkbox_agree">개인정보 이용 동의</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="mb-3 row">
                    <div class="col-md-9 ms-auto">
                      <button type="submit" class="btn btn-primary btn-sm" style="width:80px">SEND</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div> <!-- row -->
      </div> <!-- modal body -->
    </div> <!-- modal-content -->
  </div> <!-- modal-dialog -->

<script>
$(document).ready(function() {
  $("#contact-form").submit(function(e) {
    e.preventDefault();
    
    if ($(":input[name='contact']").val() == "") {
      alert("연락처를 입력하여 주십시오");
      $(":input[name='contact']").focus();
      return;
    }
    
    if ($(":input[name='content']").val() == "") {
      alert("내용을 입력하여 주십시오");
      $(":input[name='content']").focus();
      return;
    }
    
    if ($(":input[name='agree']").prop("checked") == false) {
      alert("개인정보 이용 동의를 확인해 주세요");
      $(":input[name='agree']").focus();
      $(":input[name='agree']").select();
      return;
    }
    
    $(":input[type='submit']").html("<i class='fas fa-circle-notch fa-spin mx-auto'></i>");
    
    $.post("/modals/contact_form_save.php", $("#contact-form").serialize(), function(response) {
      $(":input[type='submit']").html("SEND");
      if (response.result) {
        alert("문의해 주셔서 감사합니다.\n\n검토 후 빠른 시간에 연락드리겠습니다.");
        $("#contact-form-modal").modal("hide");
      } else {
        alert("문의 내용이 정상적으로 전달되지 않았습니다.");
      }
    }, "json").fail(function(xhr) {
      console.log("contact_form_save fail");
      console.log(xhr);
    });
    
  });
});
</script>
