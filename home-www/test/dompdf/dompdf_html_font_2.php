<?php
use Dompdf\Dompdf;

require '../vendor/autoload.php';

$html = <<<HTML
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Tangerine&display=swap" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
<style>

.m {
    font-family: 'Montserrat';
}

.t {
    font-family: 'Tangerine';
}
.n {
    font-family: 'Noto Sans KR';
}

@font-face {
    font-family: nanum;
    font-style: normal;
    font-weight: normal;
    src:url('/tmp/fonts/NanumGothic-Regular.ttf')
      format('truetype');
}

@font-face {
  font-family: nanumB;
  font-style: normal;
  font-weight: bold;
  src:url('/tmp/fonts/NanumGothic-Bold.ttf')
    format('truetype');
}

.na {
    font-family: 'nanum';
}

</style>
</head>
<body>
    <p class="m">
        Montserrat
    </p>
    <p class="t">
        Tangerine
    </p>
    <p class="na">
        한글은
    </p>
</body>
</html>
HTML
;

//$_dompdf_show_warnings = true;
//$_dompdf_debug = true;

$tmp = sys_get_temp_dir();
//$tmp = "/home/datafirst/datafirst/home-www/tmp";


$dompdf = new Dompdf([
    'logOutputFile' => '',
    // authorize DomPdf to download fonts and other Internet assets
    'isRemoteEnabled' => true,
    // all directories must exist and not end with /
    'fontDir' => $_SERVER['DOCUMENT_ROOT'] . '/tmp/fonts',
    'fontCache' => $_SERVER['DOCUMENT_ROOT'] . '/tmp/fonts',
    'tempDir' => $tmp,
    'chroot' => $tmp,
]);

$dompdf->loadHtml($html); //load an html

$dompdf->render();

$dompdf->stream('hello.pdf', [
    'compress' => true,
    'Attachment' => false,
]);
