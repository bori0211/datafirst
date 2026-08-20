<?
	// REQUIRE FILES (필수)
	require "../config.inc.php";
	require "../set_init_data.inc.php";
	require "../function.inc.php";
	
	// MYSQLi INSTANCE
	$mysqli = mysqli_instance();
	
	$selected_menu_id = 411;
	
	$PHP_SELF = "/dialysis/bloodline";
	
	
	
	// HEADER INCLUDE
	include "../header.inc.php";
?>




    <table class="table">
      <tbody>
        <tr>
          <td class="text-start" style="width:20%">
            <!-- BLANK -->
          </td>
          <td class="text-center" style="width:60%">
            <h1>테스트 타이틀</h1>
          </td>
          <td class="text-start" style="width:20%">
            <!-- BLANK -->
          </td>
        </tr>
      </tbody>
    </table>
    
    <ul class="subtitle">
      <li>테스트 서브 타이틀</li>
    </ul>
    
    <table class="table">
      <tbody>
        <tr>
          <th class="text-center border-top" width="30%" rowspan="4">수집하는 기본 개인정보 항목</th>
          <td class="text-center" width="20%">이름</td>
          <td class="text-start">홍길동</td>
        </tr>
        <tr>
          <td class="text-center">주소</td>
          <td class="text-start">서울 동작구 만양로7</td>
        </tr>
        <tr>
          <td class="text-center">연락처</td>
          <td class="text-start">010-9077-3802</td>
        </tr>
        <tr>
          <td class="text-center">e메일</td>
          <td class="text-start"></td>
        </tr>
        
      </tbody>
    </table>


<?
	// FOOTER INCLUDE
	include "../footer.inc.php";
	
	// MYSQLi CLOSE
	$mysqli->close();
?>
