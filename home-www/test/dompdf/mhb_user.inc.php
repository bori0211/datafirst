<?
	// get_mhb_user
	function get_mhb_user($mysqli, $id) {
		list($hosp_logo_img, $hosp_name, $hosp_address, $hosp_zip_code) = $mysqli->query_fetch_first_row("SELECT get_data_img(logo_img), name, address, zip_code FROM mhb_hospital WHERE org_code = '" . $_SESSION["s_org_code"] . "'");
		list($hosp_homepage_url, $hosp_tel_no, $hosp_fax_no, $hosp_email) = $mysqli->query_fetch_first_row("SELECT homepage_url, tel_no, fax_no, email FROM mhb_hospital WHERE org_code = '" . $_SESSION["s_org_code"] . "'");
		
		$hosp_address = nl2br($hosp_address);
		
		ob_start();
?>

<table border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td width="24%"><img src="<?= $hosp_logo_img ?>"></td>
    <td width="1%"></td>
    <td width="25%" align="left">
      <table border="0" cellspacing="0" cellpadding="1">
      <tr><td><span style="font-size:14px;"><?= $hosp_name ?></span></td></tr>
      <tr><td><?= $hosp_address ?></td></tr>
      <tr><td>(우편번호: <?= $hosp_zip_code ?>)</td></tr>
      </table>
    </td>
    <td width="25%">
      <table border="0" cellspacing="0" cellpadding="1">
    <? if ($hosp_homepage_url != "") { ?>
      <tr><td><span style="font-size:12px;"><?= $hosp_homepage_url ?></span></td></tr>
    <? } ?>
      <tr><td>Tel: <?= $hosp_tel_no ?></td></tr>
    <? if ($hosp_fax_no != "") { ?>
      <tr><td>Fax: <?= $hosp_fax_no ?></td></tr>
    <? } ?>
    <? if ($hosp_email != "") { ?>
      <tr><td>E-mail: <?= $hosp_email ?></td></tr>
    <? } ?>
      </table>
    </td>
    <td width="1%"></td>
    <td width="24%" align="left">
      <!--
      <table border="2" cellspacing="0" cellpadding="8">
      <tr><td align="center"><span style="font-size:22px;">재직 증명서</span></td></tr>
      </table>
      -->
    </td>
  </tr>
</table>

<?
	$query = "SELECT type, name, enter_date, leave_date, ssn, address FROM mhb_user";
	$query .= " WHERE id = " . $id;
	
	$res = $mysqli->query($query) or exit($mysqli->error);
	
	if ($row = $res->fetch_row()) {
		$type = $row[0];
		$name = $row[1];
		$enter_date = $row[2];
		$leave_date = $row[3];
		$ssn = $row[4];
		$address = $row[5];
		
		$address_display = nl2br($address);
		
		$serial_no = date("Ym") . "-01호";
		
		$enter_date_Y = date("Y", mktime(0, 0, 0, substr($enter_date, 5, 2), substr($enter_date, 8, 2), substr($enter_date, 0, 4)));
		$enter_date_n = date("n", mktime(0, 0, 0, substr($enter_date, 5, 2), substr($enter_date, 8, 2), substr($enter_date, 0, 4)));
		$enter_date_j = date("j", mktime(0, 0, 0, substr($enter_date, 5, 2), substr($enter_date, 8, 2), substr($enter_date, 0, 4)));
		
		if ($leave_date != "") {
			$leave_date_Y = date("Y", mktime(0, 0, 0, substr($leave_date, 5, 2), substr($leave_date, 8, 2), substr($leave_date, 0, 4)));
			$leave_date_n = date("n", mktime(0, 0, 0, substr($leave_date, 5, 2), substr($leave_date, 8, 2), substr($leave_date, 0, 4)));
			$leave_date_j = date("j", mktime(0, 0, 0, substr($leave_date, 5, 2), substr($leave_date, 8, 2), substr($leave_date, 0, 4)));
		}
?>


<br>
<div></div>

<table border="1" cellspacing="0" cellpadding="0">
<tr>
<td>
  <table border="0" cellspacing="0" cellpadding="8">
  <tr>
  <td colspan="2" style="line-height: 30px">
    <span style="font-size:16px; color:grey;">번호: <?= $serial_no ?></span>
  </td>
  </tr>
  </table>
  
  <div></div>
  
  <table border="0" cellspacing="0" cellpadding="8">
  <tr>
  <td colspan="2" align="center" valign="middle">
    <span style="font-size:42px;">시험중인 PDF 문서</span><br>
    <i class="far fa-plug fa-fw"></i>
  </td>
  </tr>
  <tr>
  <td colspan="2" align="center" valign="middle">
    <!-- BLANK -->
  </td>
  </tr>
  </table>
  
  <div></div>
  
  <table border="0" cellspacing="0" cellpadding="4">
  <tr style="line-height:24px;">
  <td width="30%" align="right">
    <span style="font-size:18px;">성  명 :</span>
  </td>
  <td width="70%" align="left">
    <span style="font-size:18px;"><?= $name ?></span>
  </td>
  </tr>
  
  </table>
  
  <div></div>
  
  
  <div></div>
  
  <table border="0" cellspacing="0" cellpadding="60">
  <tr>
  <td>&nbsp;</td>
  </tr>
  </table>
  
  
  <table border="0" cellspacing="0" cellpadding="10">
  <tr>
  <td align="center">
    <span style="font-size:16px;"><?= date("Y") ?> 년 <?= date("n") ?> 월 <?= date("j") ?> 일</span>
  </td>
  </tr>
  <tr>
  <td align="center">
    <span style="font-size:28px; letter-spacing: 10px;"><?= $hosp_name ?></span><br>
  </td>
  </tr>
  <tr>
  <td align="center">
    &nbsp;
  </td>
  </tr>
  </table>
  
  
</td>
</tr>
</table>




<?
		}
		
		$output = ob_get_contents();
		
		ob_end_clean();
		
		return $output;
	}
?>