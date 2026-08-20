# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## 저장소 구성

루트에는 빌드 시스템이 없다. 서로 독립적인 4개의 웹사이트에 파이썬 학습 폴더 하나를 더한 형태이고, 웹사이트는 각 디렉터리가 곧 웹서버의 도큐먼트 루트다. 한 프로젝트를 고칠 때 다른 프로젝트를 함께 고려할 필요는 거의 없다.

| 디렉터리 | 스택 | 배포처 |
|---|---|---|
| `home-www` | PHP + Apache + MySQL, Composer, Bower | www.datafirst.co.kr |
| `home-express` | Node.js + Express 5 + EJS + MySQL | express.datafirst.co.kr |
| `home-hemochart` | PHP + Apache + MySQL (home-www의 축소판) | www.hemochart.com |
| `home-vanilla` | 바닐라 JS + Firebase (빌드 없음) | vanilla.datafirst.co.kr |
| `home-python` | Python 3.13 + uv + Streamlit (학습용) | 배포 없음 |

- 루트의 `README.md`는 저장소 소개와 환경 준비 절차, `SystemSetting.md`는 서버/RDS/Apache/php.ini 운영 메모다. `MessagerDisplay.md`·`DevInterview.md`·`DesignPubInterview.md`는 코드와 무관한 개인 메모다.
- **이 저장소는 GitHub에 public으로 공개돼 있다**(`bori0211/datafirst`). 커밋하는 모든 내용이 즉시 공개된다는 전제로 작업할 것. 아래 "시크릿 취급" 참고.
- `.gitignore`의 시크릿 패턴은 **경로 앵커 없이** 파일명만 적혀 있다(`config.inc.php`, `config.js`, `google_keys.json`, `firebase-config.js`, `.env`). `config.inc.php` 하나가 home-www와 home-hemochart 양쪽을 커버하므로 앵커를 붙이면 한쪽 시크릿이 추적 대상이 된다. 여기에 디렉터리 패턴 `secrets/`가 더해진다 — GCP 서비스 계정 키는 저장소 루트 `secrets/` 한 곳에만 둔다(아래 "gitignore된 필수 설정 파일" 참고). 또 `.gitignore`는 줄 끝 주석을 지원하지 않으므로(패턴의 일부로 해석된다) 설명은 반드시 별도 줄에 둘 것.
- `.gitignore`에는 그 밖에 의존성 디렉터리(`bower/`, `node_modules/`, `vendor/`), 로그(`*.log`), 파이썬(`.venv/`, `venv/`, `__pycache__/`, `*.py[cod]`), SQLite(`*.db`, `*.db-shm`, `*.db-wal`, `*.sqlite3`), 레거시 폴더(`ohmyapple/`, `ohmyphone/`, `ohmyspon/`)가 들어 있다.
- **락 파일은 커밋한다.** `home-www/composer.lock`, `home-hemochart/composer.lock`, `home-express/package-lock.json` 세 개가 추적 대상이다(`home-python/uv_test/uv.lock`도 함께 추적된다). 자세한 방침은 아래 "의존성 버전 관리" 참고.

## 명령어

### home-express

```bash
npm run nodemon      # 개발 (nodemon.json이 PORT=3001 지정)
npm run single       # node ./bin/www 로 단발 실행 (PORT 미지정 시 3000)
npm start            # pm2 (ecosystem.config.js, watch: true)
npm run start:prod   # pm2 --env production
npm run stop         # pm2 delete
```

`nodemon`·`pm2`는 devDependencies에 없다. 전역 설치를 전제로 한다.

테스트 러너는 없다. `tests/`의 `server.js`·`test.js`·`test_influxdb2.js`는 `node tests/test.js` 처럼 직접 돌리는 실험용 스크립트다.

### PHP 사이트 (home-www, home-hemochart)

```bash
composer install
```

CLI 배치 스크립트는 `home-www/cli/` 에 5개 있고 전부 `php_sapi_name() != "cli"` 면 즉시 종료한다. 크론 등록은 저장소 밖(서버 crontab)에 있다.

```bash
php home-www/cli/minutely_save_ga_hemochart.php
```

- `minutely_save_ga_hemochart.php` / `minutely_save_ga_lcampus.php` — GA4 실시간 `activeUsers`(1분 전 / 최근 30분)를 읽어 InfluxDB Cloud 버킷 `datafirst`의 `ga2` measurement에 기록한다. property_id는 각각 `307755691`, `312666327`이고 `host` 태그로 구분한다.
- `get_ga_data.php`·`get_influxdata.php`·`set_influx_data.php` — 위 흐름을 쪼개 놓은 실험용.

### 의존성 버전 관리

**락 파일은 커밋한다.** 세 개가 추적 대상이고, home-vanilla는 패키지 매니저가 없어 해당 없다.

```
home-www/composer.lock
home-hemochart/composer.lock
home-express/package-lock.json
```

- **배포·재설치는 `npm ci` / `composer install`** 을 쓴다. 락 파일에 적힌 버전을 그대로 설치한다. `npm update`·`composer update`는 버전을 올릴 의도가 있을 때만 쓰고, 갱신된 락 파일을 반드시 함께 커밋한다.
- `composer install`은 락 파일이 없으면 `composer update`처럼 동작해 `^` 범위 안 최신을 새로 해석한다. 락 파일을 지우지 말 것.
- **`package.json`의 버전 범위를 바꾸면 반드시 `npm install`을 한 번 돌린다.** `package-lock.json` 루트의 `packages[""].dependencies`가 `package.json`의 선언을 복사해 두는데, 둘이 어긋나면 `npm ci`가 "can only install packages when your package.json and package-lock.json are in sync" 에러로 실패한다. 이때 `npm install`은 범위를 만족하는 기존 버전을 유지한 채 그 한 줄만 갱신한다.
- 의존성은 전부 `^` 범위로 지정한다. 과거 `googleapis`가 `"latest"`로 잡혀 있어 설치할 때마다 최신 메이저가 들어왔고, `routes/telegraf.js`의 Google Sheets 연동이 예고 없이 깨질 수 있는 상태였다. 현재는 `^176.0.0`으로 고정돼 있다. 새 패키지를 추가할 때도 `latest`를 쓰지 말 것.

### 프런트엔드 의존성 · SCSS

Bower를 아직 쓴다. `.bowerrc`가 설치 경로를 지정한다: home-www/home-hemochart는 `./bower`, home-express는 `./public/bower`. home-vanilla는 Bower 없이 CDN만 쓴다.

`bower/`·`node_modules/`·`vendor/`는 모두 gitignore 대상이라 머신마다 각각 설치해야 한다. 설치 여부는 머신마다 다르니 작업 전에 디렉터리 존재를 직접 확인할 것. 프로젝트별로 필요한 명령과 설치 위치는 아래와 같다.

| 프로젝트 | 필요한 명령 | 설치 위치 |
|---|---|---|
| home-www | `composer install` + `bower install` | `vendor/`, `bower/` |
| home-hemochart | `composer install` + `bower install` | `vendor/`, `bower/` |
| home-express | `npm ci` + `bower install` | `node_modules/`, `public/bower/` |
| home-vanilla | 없음 (CDN만 사용) | — |

**Bower에는 락 파일 개념이 없다.** `bower.json`의 `^` 범위가 설치 시점마다 새로 해석되므로, npm·Composer와 달리 버전이 고정되지 않는다. FontAwesome은 home-www만 `^6.0.0`, home-hemochart·home-express는 `^5.0.0`으로 선언돼 있어 메이저가 갈린다(의도된 차이).

`bower install`을 빠뜨리면 Bootstrap·jQuery·FontAwesome을 `/bower/...` 경로에서 직접 링크하는 세 사이트가 CSS·JS 없이 뜬다. 아이콘만 깨진다면 `bower/fontawesome/webfonts/`가 있는지 확인할 것 — `all.min.css`가 `../webfonts`를 상대 참조한다.

`home-www/test/` 의 일부 실험 페이지는 `bower.json`에 없는 패키지(`fontawesome-pro`, `fullcalendar`, `bootstrap-datepicker`, `toastr`)를 참조해 설치 후에도 깨진 채로 남는다. 배포 대상이 아니므로 정상이다. 특히 `fontawesome-pro`는 유료 라이선스라 인증 없이는 설치되지 않는다.

`vendor/`도 웹으로 직접 서빙된다 — `home-www/header.inc.php`가 `/vendor/twbs/bootstrap-icons/font/bootstrap-icons.css`를 직접 링크한다(home-www 전용, hemochart는 참조 없음). Composer 패키지를 지울 때 이 참조를 확인할 것.

CSS는 SCSS 컴파일 결과물이며 커밋된다. `home-www/custom/`·`home-hemochart/custom/`에 한 줄짜리 `csspack.sh`가 있다:

```bash
sass --style=compressed --no-source-map style.scss style.css
```

`home-express/public/custom/`과 `home-vanilla/custom/`에는 `csspack.sh`가 없고 `style.css.map`이 함께 커밋되어 있다(소스맵 포함, 비압축으로 컴파일된 결과).

## gitignore된 필수 설정 파일

없으면 앱이 뜨지 않는데 저장소에는 없다. 작업할 머신마다 직접 만들어야 하고, 새로 만들 때는 아래 형태를 따른다. (어느 머신에 무엇이 있는지는 머신마다 다르므로 여기 적지 않는다. `ls` 로 직접 확인할 것.)

| 파일 | 내용 |
|---|---|
| `home-www/config.inc.php` | `$db_config` + `define()` 상수 |
| `home-hemochart/config.inc.php` | `$db_config` + `define()` 상수 |
| `home-express/config.js` | `JWT_KEY`, `MYSQL_HOST/PORT/USER/PASSWORD/DATABASE`, `GMAIL_CHICKENDINNER_PASSWORD` |
| `secrets/google_keys.json` | GCP 서비스 계정 키. home-www의 GA4 조회와 home-express의 Google Sheets 기록이 **한 파일을 공용**한다 |
| `home-vanilla/firebase-config.js` | `firebaseConfig` 객체 (Firebase 웹 config) |

**`secrets/`는 저장소 루트에 있다** — 각 사이트의 도큐먼트 루트(`home-www/`, `home-express/` …)보다 한 단계 위라서 웹으로 서빙되지 않는다. 참조는 전부 `__DIR__ . "/../../secrets/google_keys.json"`(PHP) / `require('../../secrets/google_keys.json')`(Node) 형태의 상대 경로다. **따라서 서버에도 저장소가 통째로 체크아웃돼 있어야 하고, 사이트 디렉터리만 떼어 배포하면 GA 배치와 `/telegraf`가 전부 깨진다.**

- `config.inc.php`는 JSON 문자열을 `json_decode`한 `$db_config` 배열과 `define()` 상수들로 이뤄진다. home-www는 `GOOGLE_MAPS_JS_KEY`, `YOUTUBE_KEY`, `YOUTUBE_DEVELOPER_KEY_KEY`, `GMAIL_*_PASSWORD`(hemochart / datafirst / webframe / chickendinner / rollenglish), `INFLUXDATA_TOKEN`을 정의하고, home-hemochart는 `GOOGLE_MAPS_JS_KEY`, `GMAIL_HEMOCHART_PASSWORD`만 정의한다. **실제 시크릿이 평문으로 들어 있으므로 내용을 출력하거나 다른 파일로 옮기지 말 것.**
- **home-express는 `config.js`와 `secrets/google_keys.json`이 다 없으면 부팅 자체가 안 된다.** `app.js`가 `routes/telegraf.js`를 무조건 마운트하는데 이 파일이 최상단에서 `require('../../secrets/google_keys.json')`을 하고, `mysqlPool.js`는 `require('./config')`를 한다. 둘 중 하나라도 없으면 `npm run nodemon`이 즉시 모듈 로드 에러로 죽는다. `config.js`에서 실제로 읽히는 키는 `mysqlPool.js`의 `MYSQL_HOST`·`MYSQL_USER`·`MYSQL_PASSWORD`·`MYSQL_DATABASE`, `restful.js`·`check_auth.js`의 `JWT_KEY`, `routes/lambda.js`의 `GMAIL_CHICKENDINNER_PASSWORD` 여섯 개다. `MYSQL_PORT`는 파일에 있어도 읽히지 않는다(mysql2 기본값 3306을 쓴다).
- `secrets/google_keys.json`이 없으면 home-www의 `cli/*_ga_*.php`와 `modals/test_ga*.php`가 실패한다(일반 웹 페이지는 영향 없음).
- `home-vanilla/firebase-config.js`는 **gitignore 대상이라 머신마다 직접 만들어야 한다.** 예전에는 의도적으로 커밋돼 있었으나 지금은 추적하지 않는다(아래 "시크릿 취급" 참고).

## 시크릿 취급

저장소가 public이므로 아래를 전제로 판단할 것.

- **`home-express/routes/lambda.js`의 Gmail 하드코딩은 정리됐다.** 지금은 `config.GMAIL_CHICKENDINNER_PASSWORD`를 읽고, 백업 파일이던 `routes/lambda.sav.js`는 삭제됐다. 히스토리도 재작성돼 현재 저장소 어느 커밋에도 평문 비밀번호가 남아 있지 않다. 공개됐던 `chickendinner.me@gmail.com` 앱 비밀번호는 **2026-08-20에 재발급했으므로 노출된 옛 값은 무효다.** 다만 이 건에서 얻을 교훈은 남겨 둔다 — **한 번 public으로 공개된 자격증명은 히스토리를 지워도 무효화되지 않는다.** GitHub는 force-push 뒤에도 unreachable 커밋을 SHA로 한동안 서빙하고, 포크·클론·코드검색 캐시에도 남는다. 재발급만이 해결책이다.
- **`home-vanilla/firebase-config.js`는 현재 gitignore 대상이다.** 과거에는 의도적으로 커밋했으나 지금은 `.gitignore`에 `firebase-config.js` 패턴이 살아 있고 파일도 추적되지 않는다. Firebase 웹 config(`apiKey` 등)는 원래 브라우저로 배포되는 공개값이라 자격증명 유출과는 성격이 다르지만, **안전성이 전적으로 Realtime Database 보안 규칙에 달려 있다.** `waitingBoard`·`users/<uid>`에 비인증 쓰기가 열려 있지 않은지가 실제 방어선이다.
- 새 시크릿을 추가할 때는 `.gitignore` 패턴부터 확인하고, `git add` 전에 `git status`로 걸리는지 볼 것.

## 줄바꿈(CRLF/LF)

Linux 서버(datafirst-ec2, hermes-vps)와 Windows PC를 오가며 커밋한다. `.gitattributes`가 없고 `core.autocrlf`도 설정돼 있지 않아 커밋되는 줄바꿈이 그대로 저장된다. 이미 추적 파일이 LF/CRLF로 갈려 있고 `home-www/sample/BizPage/css/style.css`는 한 파일 안에 혼재한다. **기존 파일을 편집할 때 에디터가 파일 전체 줄바꿈을 바꾸지 않도록 주의할 것** — 한 줄만 고쳐도 전체가 diff로 뜬다.

## PHP 사이트 아키텍처

`home-www`와 `home-hemochart`는 같은 골격을 복사해 쓴다. 모든 페이지가 아래 순서를 지킨다.

```php
<?
	require "./config.inc.php";        // $db_config, define() 상수
	require "./set_init_data.inc.php"; // addslashes, extract($_REQUEST), 로케일, no-cache 헤더
	require "./function.inc.php";      // DB가 필요한 페이지만 (index/hemo/websign/catalog/faq는 안 부름)
	
	$selected_menu = "home";           // header.inc.php의 내비 활성 표시에 쓰임
	
	include "./header.inc.php";        // <!DOCTYPE> ~ <nav> 까지
?>
	... 본문 ...
<?
	include "./footer.inc.php";
?>
```

- **`<?` 숏 오픈 태그를 전제로 한다.** `php.ini`에 `short_open_tag=On`이 필요하다(`SystemSetting.md` 참고). 배포되는 페이지(`index.php`·`hemo.php`·`websign.php`·`catalog.php`·`faq.php`·`sitemap.php`, `*.inc.php`, `modals/`, `cli/`의 GA·Influx 배치 4개)는 전부 `<?`를 쓰므로 새 코드도 이 스타일을 유지한다. `<?php`를 쓰는 파일은 `phpinfo.php`(두 사이트), `cli/get_influxdata.php`, 그리고 `test/`·`sample/` 아래 실험 코드들이다.
- `function.inc.php`는 `header.inc.php`가 부르지 않는다. DB나 Composer 오토로더가 필요한 페이지가 3번째 줄에서 직접 `require` 한다.
- `function.inc.php`가 Composer 오토로더를 불러오고 `mysqli_ext`(mysqli 상속)를 정의한다. DB는 `mysqli_instance()`로 얻고, 조회는 `query_fetch_first_row()`(숫자 인덱스 배열) / `query_fetch_all()`(기본 `MYSQLI_ASSOC`)을 쓴다. **`MYSQLI_REPORT_OFF`로 예외를 꺼 놓았기 때문에** 쿼리 실패는 던져지지 않고 `error_log()`에만 남은 뒤 `false`가 반환된다. 반환값을 반드시 확인할 것. 접속 후 문자셋이 `utf8mb4`가 아니면 즉시 `exit`한다.
- `set_init_data.inc.php`가 `extract($_REQUEST, EXTR_SKIP)`로 요청 파라미터를 전역 변수로 풀어놓는다. 레거시 `register_globals` 흉내이므로, 페이지 안에 선언 없이 등장하는 전역 변수는 URL 파라미터에서 왔을 수 있다. 같은 파일이 `addslashes`(magic_quotes 흉내)와 `Cache-Control: no-store` 헤더도 건다.
- 라우팅은 `.htaccess` rewrite 뿐이고, 실제 파일/디렉터리가 아닐 때만 적용된다.
  - home-www: `/hemo` → `hemo.php`, `/websign` → `websign.php`
  - home-hemochart: `/kidneylife`, `/catalog`, `/faq` + `/sitemap.xml` → `sitemap.php`
  - 새 메뉴 페이지를 추가하면 `.htaccess`에 `RewriteRule ^name$ /name.php` 한 줄을 같이 넣어야 확장자 없는 URL이 동작한다.
- **home-hemochart에만 `header.meta.php`가 있다.** `$selected_menu` 값으로 분기해 title/description/canonical/og/twitter 메타를 내보내고 `header.inc.php`가 이를 include한다. hemochart에 페이지를 추가하면 `.htaccess`, `header.inc.php` 내비, `header.meta.php` 분기, `sitemap.php`의 `$hemochart_contents` 배열까지 네 곳을 같이 손봐야 한다.
- 들여쓰기는 탭이다.

### CONTACT 모달 · 메일 발송

두 사이트 공통 흐름이다.

1. `footer.inc.php`에 빈 `<div id="contact-form-modal">`만 두고,
2. `custom/app.js`가 `.contact-btn` 클릭 시 jQuery `.load()`로 `/modals/contact_form.php`를 끌어와 Bootstrap Modal로 띄우고,
3. 폼은 `modals/contact_form_save.php`로 POST → PHPMailer가 Gmail SMTP(587/TLS)로 발송하고 `{"result": true|false}` JSON만 돌려준다. SMTP 계정과 비밀번호는 사이트마다 다르다 — home-www는 `chickendinner.me@gmail.com` / `GMAIL_CHICKENDINNER_PASSWORD`, home-hemochart는 `hemochart.contact@gmail.com` / `GMAIL_HEMOCHART_PASSWORD`를 쓴다.

**`GMAIL_CHICKENDINNER_PASSWORD`는 두 프로젝트가 공용한다** — home-www의 CONTACT 모달과 home-express의 `POST /lambda/sendmail`이 같은 Gmail 계정을 쓴다. 앱 비밀번호를 재발급하면 `home-www/config.inc.php`와 `home-express/config.js` **두 파일을 함께** 고쳐야 하고, 둘 다 gitignore 대상이라 개발 PC와 서버에서 각각 손봐야 한다. 한쪽만 고치면 다른 쪽이 조용히 실패한다(PHPMailer는 `{"result": false}`, nodemailer는 로그에만 에러).

`home-www/modals/contact_form_save.lambda.php`는 같은 폼을 메일 대신 AWS Lambda Function URL로 POST하는 대안 구현이다(현재 프런트에서 호출하지 않음).

Google Maps는 `footer.inc.php`에서 `GOOGLE_MAPS_JS_KEY`를 심어 `loading=async&callback=Function.prototype`로 로드하고, 모달이 열린 뒤 `custom/app.js`의 `initializeGMap()`이 `#map-canvas`를 그린다.

### 기타

- **home-www는 PWA다.** `header.inc.php`가 `manifest.json`을 링크하고 `custom/app.js`가 `/sw.js`를 등록한다. `sw.js`는 아직 install/activate 로그만 찍는 빈 껍데기라 캐싱 동작은 없다.
- 애널리틱스는 home-www가 GA4(`G-DJLB1YNXHW`), home-hemochart가 UA(`UA-140428812-1`)로 서로 다르다.
- JS로 하던 `http → https` 강제 이동은 네 프로젝트의 `custom/app.js`에서 모두 주석 처리됐다(서버/CDN 단에서 처리한다는 전제).
- `home-www/test/`는 라이브러리 실험장(dompdf, tcpdf, phpoffice, dropzone, fullcalendar, redis, jwt, GD, exif …)이고 `home-www/sample/`은 받아둔 HTML 템플릿이다. 배포 코드가 아니므로 참고만 할 것.

## home-express 아키텍처

`bin/www`(HTTP 서버, `PORT` 환경변수, `0.0.0.0` 바인드) → `app.js`(미들웨어 + 라우터 마운트) 구조. 계층은 route → controller → model 이지만 일관되지 않다.

| 마운트 | 파일 | 특징 |
|---|---|---|
| `/` | `routes/index.js` | 인덱스 뷰 렌더 |
| `/products` | `routes/products.js` | **유일하게** `controllers/products.js`로 위임하는 화면용 CRUD |
| `/product-json` | `routes/product-json.js` | 라우터 안에서 SQL 직접 조립 |
| `/restful` | `routes/restful.js` | JWT 발급 + products REST API |
| `/telegraf` | `routes/telegraf.js` | Telegraf HTTP output 수신 → Google Sheets 기록 |
| `/lambda` | `routes/lambda.js` | Lambda POST 수신 + nodemailer 메일 발송 |
| `/test` | `routes/test.js` | 200/400 응답 확인용 |

- `app.js`에 라우터 밖의 인라인 `GET /tmp` 핸들러가 하나 남아 있다.
- **DB 풀은 `models/`가 아니라 프로젝트 루트의 `mysqlPool.js`다.** `mysql2`의 `createPool(...).promise()`를 그대로 export하며, 라우터든 모델이든 `require('../mysqlPool')`로 직접 가져다 쓴다.
- `models/`는 그 풀을 감싼 정적 메서드 클래스 `ProductProvider`(`models/product.js`), `UserProvider`(`models/user.js`)다. 테이블은 `pdt`, `usr`, `usr_token`, 그리고 `routes/lambda.js`가 쓰는 `lambda_data`. **쿼리를 템플릿 문자열로 조립한다 — 플레이스홀더를 쓰지 않는다.** 기존 스타일을 따라 확장할 때도 이 점을 인지하고, 새 코드에는 반드시 `mysql.query(sql, params)` 형태를 쓸 것.
- 인증: `POST /restful/getToken`이 `usr` 테이블의 평문 비밀번호를 비교해 1시간짜리 JWT를 발급하고 시도 이력을 `usr_token`에 남긴다. `middleware/check_auth.js`가 `Authorization: Bearer <token>`을 검증하지만 **끼워져 있는 라우트는 `GET /restful/products/:id` 하나뿐이다.** 나머지 REST 엔드포인트(POST/PUT/PATCH/DELETE 포함)는 전부 무인증이다.
- 뷰는 EJS인데 델리미터를 PHP식으로 바꿔 놨다: `app.set('view options', { delimiter: '?', outputFunctionName: 'echo' })`. 템플릿에서 `<% %>`가 아니라 `<? ?>` / `<?= ?>`를 쓰고, include는 `<?- include('header') ?>` 형태다(`product/` 하위 뷰는 `'../header'`). 레이아웃 엔진은 없다. `views/error.ejs`만 예외로 `<h1><?= message ?></h1>` 한 줄뿐이라 header/footer를 include하지 않는다.
- `routes/telegraf.js`는 Telegraf가 POST한 metrics에서 cpu/mem 필드를 뽑아 `googleapis` JWT 인증(`../../secrets/google_keys.json`)으로 지정 스프레드시트에 한 행씩 append한다. MySQL 저장 코드는 전부 주석 처리된 상태다.
- `routes/lambda.js`: `POST /lambda`는 요청 본문을 통째로 `lambda_data`에 INSERT하고, `POST /lambda/sendmail`은 CloudWatch Logs 구독 필터가 보내는 gzip+base64 페이로드를 `zlib.unzip`으로 풀어 nodemailer로 메일을 보낸다. SMTP 비밀번호는 `config.GMAIL_CHICKENDINNER_PASSWORD`를 쓴다(예전에 소스에 하드코딩돼 있던 것을 옮긴 것 — 위 "시크릿 취급" 참고).
- CORS는 `app.js`에서 전역 `*` 허용이다(Origin/Methods/Headers 모두).
- 에러 처리는 404 → `Error` 생성 → `views/error.ejs` 렌더가 전부다.

## home-vanilla

번들러도 패키지 매니저도 없다. `index.html`이 CDN에서 FontAwesome 6.1.1과 github-markdown-css를 가져오고(Bootstrap CDN 링크는 전부 주석 처리됨), Firebase는 네임스페이스 방식 v8 SDK(`firebasejs/8.3.0`의 app/auth/database)를 직접 로드한다. 그 뒤 `firebase-config.js` → `firebase.initializeApp(firebaseConfig)` → `custom/app.js` 순으로 이어진다.

`firebase-config.js`는 다른 사이트의 설정 파일과 마찬가지로 **gitignore 대상이라 저장소에 없다.** 새 환경에서는 직접 만들어야 한다(예전에는 커밋돼 있었으니 옛 문서나 기억에 의존하지 말 것). 위 "시크릿 취급" 참고.

`custom/app.js`는 전역 `firebase` 객체로 Realtime Database의 `waitingBoard` 노드를 구독해 대기 현황판을 그리고, `firebase.auth()` 세션 로그인(`Persistence.SESSION`)으로 관리자만 값을 수정하게 한다. `users/<uid>`의 `isPayment`/`endDate`로 결제 상태를 판정한다.

`practice/`는 학습용 예제(js-basic, js-es6)다. 네 웹사이트 중 유일하게 서버 사이드 코드가 없어 정적 호스팅만으로 동작한다.

## home-python

배포되지 않는 학습용 폴더다. 웹사이트 네 개와 아무 관계가 없고, 서로 독립적인 두 디렉터리로 되어 있다.

| 디렉터리 | 내용 |
|---|---|
| `uv_test/` | uv 프로젝트 스캐폴드. `pyproject.toml`(Python `>=3.13`, `streamlit>=1.47.1`), `.python-version`(3.13), `uv.lock`, `main.py`(hello 출력) |
| `streamlit_tutorial/` | `test.py` 한 개짜리 Streamlit 예제. `pyproject.toml`이 없어 `uv_test/`의 환경을 빌려 쓰는 구조다 |

```bash
cd home-python/uv_test
uv sync                              # uv.lock 그대로 설치 (.venv/ 생성, gitignore 대상)
uv run streamlit run ../streamlit_tutorial/test.py
```

- **`uv.lock`은 커밋한다.** 재현 설치는 `uv sync`를 쓴다(`uv add`·`uv lock --upgrade`는 버전을 올릴 의도가 있을 때만, 갱신된 락 파일과 함께 커밋).
- `.venv/`·`__pycache__/`·`*.py[cod]`는 gitignore 대상이라 머신마다 `uv sync`가 필요하다.
