# home-vanilla

vanilla.datafirst.co.kr — Firebase 대기 현황판 + JS 학습용 예제. **번들러도 패키지 매니저도 없다.** 네 웹사이트 중 유일하게 서버 사이드 코드가 없어 정적 호스팅만으로 동작한다.

## 로드 순서

`index.html`이 CDN에서 Bootstrap 5.2.1 CSS·FontAwesome 6.1.1·github-markdown-css를 가져오고, Firebase는 네임스페이스 방식 v8 SDK(`firebasejs/8.3.0`의 app/auth/database)를 직접 로드한다. 그 뒤 이 순서로 이어진다.

**Bootstrap은 CSS만 로드하고 JS 번들은 없다** — 드롭다운·모달처럼 JS가 필요한 컴포넌트는 동작하지 않는다. 바로 윗줄 세 개(4.4.1 / 5.0.2 / 5.2.0)가 주석 처리돼 있어 Bootstrap을 아예 안 쓰는 것으로 오해하기 쉬우니 주의할 것.

```
firebase-config.js → firebase.initializeApp(firebaseConfig) → custom/app.js
```

`firebase-config.js`는 **gitignore 대상이라 저장소에 없다.** 새 환경에서는 직접 만들어야 한다(예전에는 의도적으로 커밋돼 있었으니 옛 문서나 기억에 의존하지 말 것). 루트 `CLAUDE.md`의 "시크릿 취급" 참고 — Firebase 웹 config는 원래 브라우저로 배포되는 공개값이지만, 안전성이 전적으로 Realtime Database 보안 규칙에 달려 있다.

## custom/app.js

전역 `firebase` 객체로 Realtime Database의 `waitingBoard` 노드를 구독해 대기 현황판을 그리고, `firebase.auth()` 세션 로그인(`Persistence.SESSION`)으로 관리자만 값을 수정하게 한다. `users/<uid>`의 `isPayment`/`endDate`로 결제 상태를 판정한다.

`waitingBoard`·`users/<uid>`에 비인증 쓰기가 열려 있지 않은지가 실제 방어선이다.

## 기타

- Bower를 쓰지 않는다(CDN만 사용). `bower install` 대상이 아니다.
- `custom/`에는 `csspack.sh`가 없고 `style.css.map`이 함께 커밋되어 있다(소스맵 포함, 비압축 컴파일 결과).
- `practice/`는 학습용 예제(js-basic, js-es6)다.
