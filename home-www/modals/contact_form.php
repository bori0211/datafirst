<?
	// REQUIRE FILES (필수)
	require __DIR__ . "/../config.inc.php";
	require __DIR__ . "/../set_init_data.inc.php";
?>

  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">CONTACT</h2>
        <button class="btn btn-modal-icon" type="button" data-bs-dismiss="modal"><i class="fas fa-times fa-fw" style="font-size:16px;"></i></button>
        <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
      </div>
      
      <div class="modal-body">
        <div class="d-flex justify-content-center">
          <div class="motd">
            <div class="text-title-block" id="we-do-best-1" style="display:none;">세상을 조금 더</div>
            <div class="text-title-block" id="we-do-best-2" style="display:none;">효율적으로 만듭니다</div>
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
                      070-4950-8500
                    </div>
                  </li>
                  <li class="d-flex single-item">
                    <div class="flex-shrink-0 single-icon"><i class="fas fa-map-marker fa-fw"></i></div>
                    <div class="flex-grow-1 ms-2">
                      서울시 동대문구 장한로 186<br>
                      남일빌딩 201호 <span class="text-secondary">(우 02522)</span>
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
                    <label class="col-md-3 col-form-label text-md-end">회사명</label>
                    <div class="col-md-9">
                      <div class="form-inline">
                        <input type="text" class="form-control input-sm" name="company" value="" placeholder="예) 데이터퍼스트" style="width:14em;">
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
