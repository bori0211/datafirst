# home-express

express.datafirst.co.kr — Express 실습 겸 API 서버. Node.js + Express 5 + EJS + MySQL.

## 명령어

```bash
npm run nodemon      # 개발 (nodemon.json이 PORT=3001 지정)
npm run single       # node ./bin/www 로 단발 실행 (PORT 미지정 시 3000)
npm start            # pm2 (ecosystem.config.js, watch: true)
npm run start:prod   # pm2 --env production
npm run stop         # pm2 delete
```

`nodemon`·`pm2`는 devDependencies에 없다. 전역 설치를 전제로 한다.

테스트 러너는 없다. `tests/`의 `server.js`·`test.js`·`test_influxdb2.js`는 `node tests/test.js` 처럼 직접 돌리는 실험용 스크립트다.

의존성 설치는 `npm ci` + `bower install`(→ `public/bower/`). FontAwesome은 `^5.0.0`으로 선언돼 있다.

## 부팅 조건

**`config.js`와 `secrets/google_keys.json`이 다 없으면 부팅 자체가 안 된다.** `app.js`가 `routes/telegraf.js`를 무조건 마운트하는데 이 파일이 최상단에서 `require('../../secrets/google_keys.json')`을 하고, `mysqlPool.js`는 `require('./config')`를 한다. 둘 중 하나라도 없으면 `npm run nodemon`이 즉시 모듈 로드 에러로 죽는다.

`config.js`에서 실제로 읽히는 키는 여섯 개다 — `mysqlPool.js`의 `MYSQL_HOST`·`MYSQL_USER`·`MYSQL_PASSWORD`·`MYSQL_DATABASE`, `restful.js`·`check_auth.js`의 `JWT_KEY`, `routes/lambda.js`의 `GMAIL_CHICKENDINNER_PASSWORD`. `MYSQL_PORT`는 파일에 있어도 읽히지 않는다(mysql2 기본값 3306을 쓴다).

`GMAIL_CHICKENDINNER_PASSWORD`는 **home-www의 CONTACT 모달과 공용**이다. 재발급 시 `home-express/config.js`와 `home-www/config.inc.php`를 함께 고칠 것.

## 아키텍처

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
- `routes/lambda.js`: `POST /lambda`는 요청 본문을 통째로 `lambda_data`에 INSERT하고, `POST /lambda/sendmail`은 CloudWatch Logs 구독 필터가 보내는 gzip+base64 페이로드를 `zlib.unzip`으로 풀어 nodemailer로 메일을 보낸다. SMTP 비밀번호는 `config.GMAIL_CHICKENDINNER_PASSWORD`를 쓴다(예전에 소스에 하드코딩돼 있던 것을 옮긴 것 — 루트 `CLAUDE.md`의 "시크릿 취급" 참고).
- CORS는 `app.js`에서 전역 `*` 허용이다(Origin/Methods/Headers 모두).
- 에러 처리는 404 → `Error` 생성 → `views/error.ejs` 렌더가 전부다.
- `public/custom/`에는 `csspack.sh`가 없고 `style.css.map`이 함께 커밋되어 있다(소스맵 포함, 비압축 컴파일 결과).
