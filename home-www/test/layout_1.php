    <br>
    <h3>기본 정보</h3>
    
    <table border="1" cellspacing="0" cellpadding="6">
      <tr>
        <th bgcolor="#cccccc" align="center">환자명</th>
        <td>김석태</td>
        <th bgcolor="#cccccc" align="center">나이</th>
        <td>45세</td>
        <th bgcolor="#cccccc" align="center">원인 질환</th>
        <td colspan="3">03. CGN(임상추정</td>
      </tr>
      <tr>
        <th bgcolor="#cccccc" align="center">혈액형</th>
        <td>ㅁ</td>
        <th bgcolor="#cccccc" align="center">성별</th>
        <td>ㅁ11</td>
        <th bgcolor="#cccccc" align="center" rowspan="2">합병 질환</th>
        <td rowspan="2" colspan="3">21212</td>
      </tr>
      <tr>
        <th bgcolor="#cccccc" align="center">보험유형</th>
        <td>직장보험</td>
        <th bgcolor="#cccccc" align="center">주민번호</th>
        <td>770211-1******</td>
      </tr>
      <tr>
        <th bgcolor="#cccccc" align="center">휴대전화</th>
        <td>010-2332-9745</td>
        <th bgcolor="#cccccc" align="center">비상연락 (집)</th>
        <td>010-2332-9745</td>
        <th bgcolor="#cccccc" align="center">HBs Ag</th>
        <td><?= $md_hbs_ag ?></td>
      </tr>
      <tr>
        <th bgcolor="#cccccc" align="center">치료 스케쥴</th>
        <td><?= $pat_sch ?></td>
        <th bgcolor="#cccccc" align="center">Allergies</th>
        <td><?= $md_allergy_yn ?> <?= $md_allergy_content ?></td>
        <th bgcolor="#cccccc" align="center">HCV Ab</th>
        <td><?= $md_hcv_ab ?></td>
      </tr>
    </table>
