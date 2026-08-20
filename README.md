# DataFirst

데이터퍼스트가 운영하는 웹사이트 4개를 한 저장소에 모아둔 곳이다.
루트에 빌드 시스템은 없고, **각 디렉터리가 그대로 웹서버의 도큐먼트 루트**가 된다. 프로젝트끼리 코드를 공유하지 않는다.

| 디렉터리 | 사이트 | 스택 |
|---|---|---|
| [`home-www`](home-www) | [www.datafirst.co.kr](https://www.datafirst.co.kr) | PHP · Apache · MySQL · Composer · Bower |
| [`home-express`](home-express) | [express.datafirst.co.kr](https://express.datafirst.co.kr) | Node.js · Express 5 · EJS · MySQL |
| [`home-hemochart`](home-hemochart) | [www.hemochart.com](https://www.hemochart.com) | PHP · Apache · MySQL (home-www의 축소판) |
| [`home-vanilla`](home-vanilla) | [vanilla.datafirst.co.kr](https://vanilla.datafirst.co.kr) | 바닐라 JS · Firebase (빌드 없음) |

<br>

## 1. home-www

<a href="https://www.datafirst.co.kr"><img src="https://www.datafirst.co.kr/assets/php_logo.jpg" alt="PHP" width="200"></a>

회사 소개 사이트. `config.inc.php` → `set_init_data.inc.php` → `header.inc.php` 순으로 include하는 전통적인 PHP 페이지 구조이고, 라우팅은 `.htaccess` rewrite로만 처리한다.
Bootstrap 5 + jQuery, PWA(manifest + service worker), CONTACT 모달은 PHPMailer로 메일을 보낸다.
`cli/`에는 GA4 실시간 지표를 읽어 InfluxDB에 적재하는 크론용 배치 스크립트가 들어 있다.

```bash
composer install
bower install
```

## 2. home-express

<a href="https://express.datafirst.co.kr"><img src="https://express.datafirst.co.kr/assets/node.js_logo.png" alt="Node.js" width="200"></a>

Express 실습 겸 API 서버. products CRUD 화면과 JWT 기반 REST API, Telegraf 메트릭 수집(→ Google Sheets), AWS Lambda 연동 엔드포인트가 있다.
뷰는 EJS지만 델리미터를 PHP식(`<? ?>`)으로 바꿔 쓴다.

```bash
npm ci
bower install
npm run nodemon      # 개발 (PORT 3001)
npm start            # pm2로 기동
```

## 3. home-hemochart

<a href="https://www.hemochart.com"><img src="https://www.hemochart.com/assets/logo_hemochart.png" alt="HemoChart" width="200"></a>

혈액 투석 관리 프로그램 HemoChart 소개 사이트. home-www와 같은 골격을 쓰되 페이지별 SEO 메타(`header.meta.php`)와 `sitemap.xml` 생성이 추가돼 있다.

```bash
composer install
bower install
```

## 4. home-vanilla

<a href="https://vanilla.datafirst.co.kr"><img src="https://www.datafirst.co.kr/assets/vanilla_js_logo.png" alt="Vanilla JS" width="200"></a>

번들러도 패키지 매니저도 없는 정적 사이트. Firebase Realtime Database를 구독하는 대기 현황판과 JS 학습용 예제(`practice/`)로 이뤄져 있다. 서버 사이드 코드가 없어 정적 호스팅만으로 동작한다.

<br>

## 개발 환경 준비

| 도구 | 비고 |
|---|---|
| PHP 8.2 이상 | `php.ini`에 `short_open_tag=On` 필요 |
| Composer | home-www, home-hemochart |
| Node.js 18 이상 | home-express (Express 5) |
| Bower (전역) | home-www, home-hemochart, home-express |
| Dart Sass | `custom/csspack.sh` 로 SCSS 컴파일 |
| pm2, nodemon (전역) | home-express 실행 스크립트가 전제로 함 |

`bower/`, `node_modules/`, `vendor/`는 gitignore 대상이므로 새 환경에서는 각각 설치해야 한다.

락 파일(`package-lock.json`, `composer.lock`)은 저장소에 커밋돼 있다. 위의 `npm ci`·`composer install`은 락 파일에 적힌 버전을 그대로 설치하므로 어느 환경에서든 결과가 같다. 버전을 올릴 때만 `npm update`·`composer update`를 쓰고, 갱신된 락 파일을 함께 커밋한다. 패키지를 추가하거나 `package.json`의 버전 범위를 바꿨다면 `npm install`을 한 번 돌려 락 파일을 맞춰야 `npm ci`가 동작한다.

Bower에는 락 파일이 없어 `bower.json`의 `^` 범위가 설치 시점마다 새로 해석된다.

### 설정 파일

DB 접속 정보와 API 키가 담긴 아래 파일들은 저장소에 포함되지 않는다. 없으면 앱이 뜨지 않으므로 배포 서버에서 직접 만들어야 한다.

```
home-www/config.inc.php
home-hemochart/config.inc.php
home-express/config.js
home-vanilla/firebase-config.js
secrets/google_keys.json
```

`secrets/`는 저장소 루트에 둔다. 각 사이트의 도큐먼트 루트보다 한 단계 위라서 웹으로 노출되지 않고, GCP 서비스 계정 키 하나를 home-www(GA4 조회)와 home-express(Google Sheets 기록)가 함께 쓴다. 코드가 `../../secrets/`로 참조하므로 **서버에도 저장소를 통째로 체크아웃해야 한다.**

각 파일의 형태와 필요한 상수 목록은 [CLAUDE.md](CLAUDE.md)에 정리돼 있다.

<br>

## 문서

- [CLAUDE.md](CLAUDE.md) — 저장소 구조, 프로젝트별 아키텍처, 코드 컨벤션
- [SystemSetting.md](SystemSetting.md) — 서버 · RDS · Apache · php.ini 운영 메모
