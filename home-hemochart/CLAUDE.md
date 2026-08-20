# home-hemochart

www.hemochart.com — 혈액 투석 관리 프로그램 HemoChart 소개 사이트. PHP + Apache + MySQL. **home-www와 같은 골격을 복사해 쓰는 축소판**이다.

PHP 페이지 골격(include 순서, `<?` 숏 오픈 태그, `function.inc.php`의 DB 헬퍼, `set_init_data.inc.php`의 `extract()`, CONTACT 모달 흐름)은 **루트 `CLAUDE.md`의 "PHP 사이트 아키텍처"** 에 있다. 여기에는 hemochart 고유 사항만 적는다.

## 페이지를 추가할 땐 네 곳을 함께 고친다

home-www와 가장 크게 다른 점이다. 하나라도 빠뜨리면 조용히 어긋난다.

1. `.htaccess` — `RewriteRule ^name$ /name.php`
2. `header.inc.php` — 내비게이션 항목
3. `header.meta.php` — `$selected_menu` 분기
4. `sitemap.php` — `$hemochart_contents` 배열

**`header.meta.php`는 hemochart에만 있다.** `$selected_menu` 값으로 분기해 title/description/canonical/og/twitter 메타를 내보내고 `header.inc.php`가 이를 include한다. home-www에는 이 파일이 없다.

## 라우팅

`.htaccess` rewrite뿐이고 실제 파일/디렉터리가 아닐 때만 적용된다.

- `/kidneylife`, `/catalog`, `/faq`
- `/sitemap.xml` → `sitemap.php`

## 설정 · 기타

- `config.inc.php`는 `GOOGLE_MAPS_JS_KEY`, `GMAIL_HEMOCHART_PASSWORD` **두 개만** 정의한다(home-www는 아홉 개).
- CONTACT 모달 SMTP 계정은 `hemochart.contact@gmail.com` / `GMAIL_HEMOCHART_PASSWORD`. home-www와 별개 계정이라 서로 영향이 없다.
- 애널리틱스는 UA(`UA-140428812-1`)다. home-www는 GA4라서 서로 다르다.
- FontAwesome은 `bower.json`에 `^5.0.0`으로 선언돼 있다(home-www는 `^6.0.0` — 의도된 차이).
- `vendor/`를 웹으로 링크하는 코드는 없다(home-www에는 있다).
- GA·InfluxDB 배치 스크립트는 이 프로젝트에 없다. hemochart의 GA4 지표는 `home-www/cli/minutely_save_ga_hemochart.php`가 대신 수집한다(property_id `307755691`).
- `secrets/google_keys.json`을 참조하는 코드도 없다.
