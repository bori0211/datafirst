# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

여기에는 **저장소 전체에 걸친 규칙**과 **두 PHP 사이트의 공용 골격**만 둔다. 프로젝트별 상세는 각 디렉터리의 `CLAUDE.md`에 있고, 그 디렉터리 파일을 다룰 때 자동으로 함께 읽힌다.

## 저장소 구성

루트에는 빌드 시스템이 없다. 서로 독립적인 4개의 웹사이트에 파이썬 학습 폴더 하나를 더한 형태이고, 웹사이트는 각 디렉터리가 곧 웹서버의 도큐먼트 루트다. 한 프로젝트를 고칠 때 다른 프로젝트를 함께 고려할 필요는 거의 없다.

| 디렉터리 | 스택 | 배포처 | 프로젝트 문서 |
|---|---|---|---|
| `home-www` | PHP + Apache + MySQL, Composer, Bower | www.datafirst.co.kr | [home-www/CLAUDE.md](home-www/CLAUDE.md) |
| `home-express` | Node.js + Express 5 + EJS + MySQL | express.datafirst.co.kr | [home-express/CLAUDE.md](home-express/CLAUDE.md) |
| `home-hemochart` | PHP + Apache + MySQL (home-www의 축소판) | www.hemochart.com | [home-hemochart/CLAUDE.md](home-hemochart/CLAUDE.md) |
| `home-vanilla` | 바닐라 JS + Firebase (빌드 없음) | vanilla.datafirst.co.kr | [home-vanilla/CLAUDE.md](home-vanilla/CLAUDE.md) |
| `home-python` | Python 3.13 + uv + Streamlit (학습용) | 배포 없음 | [home-python/CLAUDE.md](home-python/CLAUDE.md) |

- 루트의 `README.md`는 저장소 소개와 환경 준비 절차, `SystemSetting.md`는 서버/RDS/Apache/php.ini 운영 메모다. `MessagerDisplay.md`·`DevInterview.md`·`DesignPubInterview.md`는 코드와 무관한 개인 메모다.
- **이 저장소는 GitHub에 public으로 공개돼 있다**(`bori0211/datafirst`). 커밋하는 모든 내용이 즉시 공개된다는 전제로 작업할 것. 아래 "시크릿 취급" 참고.
- `.gitignore`의 시크릿 패턴은 **경로 앵커 없이** 파일명만 적혀 있다(`config.inc.php`, `config.js`, `google_keys.json`, `firebase-config.js`, `.env`). `config.inc.php` 하나가 home-www와 home-hemochart 양쪽을 커버하므로 앵커를 붙이면 한쪽 시크릿이 추적 대상이 된다. 여기에 디렉터리 패턴 `secrets/`가 더해진다. 또 `.gitignore`는 줄 끝 주석을 지원하지 않으므로(패턴의 일부로 해석된다) 설명은 반드시 별도 줄에 둘 것.
- `.gitignore`에는 그 밖에 의존성 디렉터리(`bower/`, `node_modules/`, `vendor/`), 로그(`*.log`), 파이썬(`.venv/`, `venv/`, `__pycache__/`, `*.py[cod]`), SQLite(`*.db`, `*.db-shm`, `*.db-wal`, `*.sqlite3`), 레거시 폴더(`ohmyapple/`, `ohmyphone/`, `ohmyspon/`)가 들어 있다.

## 의존성 · 설치

`bower/`·`node_modules/`·`vendor/`는 모두 gitignore 대상이라 머신마다 각각 설치해야 한다. 설치 여부는 머신마다 다르니 작업 전에 디렉터리 존재를 직접 확인할 것.

| 프로젝트 | 필요한 명령 | 설치 위치 |
|---|---|---|
| home-www | `composer install` + `bower install` | `vendor/`, `bower/` |
| home-hemochart | `composer install` + `bower install` | `vendor/`, `bower/` |
| home-express | `npm ci` + `bower install` | `node_modules/`, `public/bower/` |
| home-vanilla | 없음 (CDN만 사용) | — |

### 락 파일은 커밋한다

`home-www/composer.lock`, `home-hemochart/composer.lock`, `home-express/package-lock.json` 세 개가 추적 대상이다(`home-python/uv_test/uv.lock`도 함께 추적된다).

- **배포·재설치는 `npm ci` / `composer install`** 을 쓴다. 락 파일에 적힌 버전을 그대로 설치한다. `npm update`·`composer update`는 버전을 올릴 의도가 있을 때만 쓰고, 갱신된 락 파일을 반드시 함께 커밋한다.
- `composer install`은 락 파일이 없으면 `composer update`처럼 동작해 `^` 범위 안 최신을 새로 해석한다. 락 파일을 지우지 말 것.
- **`package.json`의 버전 범위를 바꾸면 반드시 `npm install`을 한 번 돌린다.** `package-lock.json` 루트의 `packages[""].dependencies`가 `package.json`의 선언을 복사해 두는데, 둘이 어긋나면 `npm ci`가 "can only install packages when your package.json and package-lock.json are in sync" 에러로 실패한다. 이때 `npm install`은 범위를 만족하는 기존 버전을 유지한 채 그 한 줄만 갱신한다.
- 의존성은 전부 `^` 범위로 지정한다. 과거 `googleapis`가 `"latest"`로 잡혀 있어 설치할 때마다 최신 메이저가 들어왔고, `home-express/routes/telegraf.js`의 Google Sheets 연동이 예고 없이 깨질 수 있는 상태였다. 현재는 `^176.0.0`으로 고정돼 있다. 새 패키지를 추가할 때도 `latest`를 쓰지 말 것.

### Bower · SCSS

Bower를 아직 쓴다. `.bowerrc`가 설치 경로를 지정한다: home-www/home-hemochart는 `./bower`, home-express는 `./public/bower`. home-vanilla는 Bower 없이 CDN만 쓴다.

**Bower에는 락 파일 개념이 없다.** `bower.json`의 `^` 범위가 설치 시점마다 새로 해석되므로, npm·Composer와 달리 버전이 고정되지 않는다. FontAwesome은 home-www만 `^6.0.0`, home-hemochart·home-express는 `^5.0.0`으로 선언돼 있어 메이저가 갈린다(의도된 차이).

`bower install`을 빠뜨리면 Bootstrap·jQuery·FontAwesome을 `/bower/...` 경로에서 직접 링크하는 세 사이트가 CSS·JS 없이 뜬다. 아이콘만 깨진다면 `bower/fontawesome/webfonts/`가 있는지 확인할 것 — `all.min.css`가 `../webfonts`를 상대 참조한다.

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
- **`GMAIL_CHICKENDINNER_PASSWORD`는 두 프로젝트가 공용한다** — home-www의 CONTACT 모달과 home-express의 `POST /lambda/sendmail`이 같은 Gmail 계정을 쓴다. 앱 비밀번호를 재발급하면 `home-www/config.inc.php`와 `home-express/config.js` **두 파일을 함께** 고쳐야 하고, 둘 다 gitignore 대상이라 개발 PC와 서버에서 각각 손봐야 한다. 한쪽만 고치면 다른 쪽이 조용히 실패한다.
- `home-vanilla/firebase-config.js`는 **gitignore 대상이라 머신마다 직접 만들어야 한다.** 예전에는 의도적으로 커밋돼 있었으나 지금은 추적하지 않는다.

## 시크릿 취급

저장소가 public이므로 아래를 전제로 판단할 것.

- **한 번 public으로 공개된 자격증명은 히스토리를 지워도 무효화되지 않는다.** GitHub는 force-push 뒤에도 unreachable 커밋을 SHA로 한동안 서빙하고, 포크·클론·코드검색 캐시에도 남는다. 재발급만이 해결책이다. 과거 `home-express/routes/lambda.js`에 Gmail 앱 비밀번호가 하드코딩된 채 공개된 적이 있고, 코드는 `config.js`로 옮겼으며 해당 비밀번호는 2026-08-20에 재발급했다.
- **`home-vanilla/firebase-config.js`는 현재 gitignore 대상이다.** Firebase 웹 config(`apiKey` 등)는 원래 브라우저로 배포되는 공개값이라 자격증명 유출과는 성격이 다르지만, **안전성이 전적으로 Realtime Database 보안 규칙에 달려 있다.** `waitingBoard`·`users/<uid>`에 비인증 쓰기가 열려 있지 않은지가 실제 방어선이다.
- 새 시크릿을 추가할 때는 `.gitignore` 패턴부터 확인하고, `git add` 전에 `git status`로 걸리는지 볼 것.

## 줄바꿈(CRLF/LF)

Linux 서버(datafirst-ec2, hermes-vps)와 Windows PC를 오가며 커밋한다. `.gitattributes`가 없고 `core.autocrlf`도 설정돼 있지 않아 커밋되는 줄바꿈이 그대로 저장된다. 이미 추적 파일이 LF/CRLF로 갈려 있고 `home-www/sample/BizPage/css/style.css`는 한 파일 안에 혼재한다. **기존 파일을 편집할 때 에디터가 파일 전체 줄바꿈을 바꾸지 않도록 주의할 것** — 한 줄만 고쳐도 전체가 diff로 뜬다.

## PHP 사이트 아키텍처 (home-www · home-hemochart 공용)

두 사이트는 같은 골격을 복사해 쓴다. 모든 페이지가 아래 순서를 지킨다. 사이트별 차이는 각 프로젝트의 `CLAUDE.md`에 있다.

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
- **라우팅은 `.htaccess` rewrite 뿐이고, 실제 파일/디렉터리가 아닐 때만 적용된다.** 새 메뉴 페이지를 추가하면 `.htaccess`에 `RewriteRule ^name$ /name.php` 한 줄을 같이 넣어야 확장자 없는 URL이 동작한다. hemochart는 여기에 더해 `header.meta.php`와 `sitemap.php`까지 손봐야 한다.
- 들여쓰기는 탭이다.

### CONTACT 모달 · 메일 발송

두 사이트 공통 흐름이다. SMTP 계정과 비밀번호 상수만 사이트마다 다르다.

1. `footer.inc.php`에 빈 `<div id="contact-form-modal">`만 두고,
2. `custom/app.js`가 `.contact-btn` 클릭 시 jQuery `.load()`로 `/modals/contact_form.php`를 끌어와 Bootstrap Modal로 띄우고,
3. 폼은 `modals/contact_form_save.php`로 POST → PHPMailer가 Gmail SMTP(587/TLS)로 발송하고 `{"result": true|false}` JSON만 돌려준다.

Google Maps는 `footer.inc.php`에서 `GOOGLE_MAPS_JS_KEY`를 심어 `loading=async&callback=Function.prototype`로 로드하고, 모달이 열린 뒤 `custom/app.js`의 `initializeGMap()`이 `#map-canvas`를 그린다.

### 기타

- JS로 하던 `http → https` 강제 이동은 네 프로젝트의 `custom/app.js`에서 모두 주석 처리됐다(서버/CDN 단에서 처리한다는 전제).
