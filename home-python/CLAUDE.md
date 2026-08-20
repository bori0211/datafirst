# home-python

**배포되지 않는 학습용 폴더다.** 웹사이트 네 개와 아무 관계가 없고, 서로 독립적인 두 디렉터리로 되어 있다.

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
