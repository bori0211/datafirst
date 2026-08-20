# home-www

www.datafirst.co.kr — 회사 소개 사이트. PHP + Apache + MySQL, Composer, Bower.

PHP 페이지 골격(include 순서, `<?` 숏 오픈 태그, `function.inc.php`의 DB 헬퍼, `set_init_data.inc.php`의 `extract()`, CONTACT 모달 흐름)은 home-hemochart와 공용이다. **루트 `CLAUDE.md`의 "PHP 사이트 아키텍처"를 먼저 볼 것.** 여기에는 home-www 고유 사항만 적는다.

## 라우팅

`.htaccess` rewrite뿐이고 실제 파일/디렉터리가 아닐 때만 적용된다.

- `/hemo` → `hemo.php`
- `/websign` → `websign.php`

새 메뉴 페이지를 추가하면 `.htaccess`에 `RewriteRule ^name$ /name.php` 한 줄을 같이 넣어야 확장자 없는 URL이 동작한다.

## CLI 배치 스크립트

`cli/` 에 5개 있고 전부 `php_sapi_name() != "cli"` 면 즉시 종료한다. 크론 등록은 저장소 밖(서버 crontab)에 있다.

```bash
php home-www/cli/minutely_save_ga_hemochart.php
```

- `minutely_save_ga_hemochart.php` / `minutely_save_ga_lcampus.php` — GA4 실시간 `activeUsers`(1분 전 / 최근 30분)를 읽어 InfluxDB Cloud 버킷 `datafirst`의 `ga2` measurement에 기록한다. property_id는 각각 `307755691`, `312666327`이고 `host` 태그로 구분한다.
- `get_ga_data.php`·`get_influxdata.php`·`set_influx_data.php` — 위 흐름을 쪼개 놓은 실험용.

GA4 조회에는 **저장소 루트의 `secrets/google_keys.json`** 이 필요하다(`__DIR__ . "/../../secrets/google_keys.json"`). 없으면 이 배치들과 `modals/test_ga*.php`가 실패한다 — 일반 웹 페이지는 영향 없다.

InfluxDB 기록에는 `config.inc.php`의 `INFLUXDATA_TOKEN`을 쓴다.

**`modals/test_ga2.php`는 파싱조차 되지 않는 미완성 파일이다.** Google 문서의 Python/JS 예제를 붙여넣고 PHP로 옮기지 않아 `body={...}`, `{'key': 'value'}` 같은 문법이 그대로 남아 있다(41행). 어디서도 호출되지 않으므로 방치해도 무방하지만, GA 관련 코드를 찾다가 이 파일을 참고하지 말 것. 동작하는 예시는 `cli/`와 `modals/test_ga.php`다.

## CONTACT 모달

흐름 자체는 루트 문서에 있다. home-www는 SMTP 계정으로 `chickendinner.me@gmail.com`, 비밀번호로 `config.inc.php`의 `GMAIL_CHICKENDINNER_PASSWORD`를 쓴다.

**이 상수는 home-express의 `POST /lambda/sendmail`과 공용이다.** 앱 비밀번호를 재발급하면 `home-www/config.inc.php`와 `home-express/config.js` 두 파일을 함께 고쳐야 한다. 한쪽만 고치면 다른 쪽이 조용히 실패한다.

`modals/contact_form_save.lambda.php`는 같은 폼을 메일 대신 AWS Lambda Function URL로 POST하는 대안 구현이다(현재 프런트에서 호출하지 않음).

## 기타

- **PWA다.** `header.inc.php`가 `manifest.json`을 링크하고 `custom/app.js`가 `/sw.js`를 등록한다. `sw.js`는 아직 install/activate 로그만 찍는 빈 껍데기라 캐싱 동작은 없다.
- 애널리틱스는 GA4(`G-DJLB1YNXHW`)이고 `footer.inc.php`에서 gtag.js로 로드한다(`header.inc.php`가 아니다). home-hemochart는 태그가 UA라서 서로 다르다.
- **`vendor/`도 웹으로 직접 서빙된다** — `header.inc.php`가 `/vendor/twbs/bootstrap-icons/font/bootstrap-icons.css`를 직접 링크한다(home-www 전용, hemochart는 참조 없음). Composer 패키지를 지울 때 이 참조를 확인할 것.
- FontAwesome은 `bower.json`에 `^6.0.0`으로 선언돼 있다(hemochart·express는 `^5.0.0` — 의도된 차이).
- `test/`는 라이브러리 실험장(dompdf, tcpdf, phpoffice, dropzone, fullcalendar, redis, jwt, GD, exif …)이고 `sample/`은 받아둔 HTML 템플릿이다. 배포 코드가 아니므로 참고만 할 것.
- `test/`의 일부 페이지는 `bower.json`에 없는 패키지(`fontawesome-pro`, `fullcalendar`, `bootstrap-datepicker`, `toastr`, `TCPDF`, `moment` 6개)를 참조해 `bower install` 후에도 깨진 채로 남는다. 정상이다. 특히 `fontawesome-pro`는 유료 라이선스라 인증 없이는 설치되지 않는다.
