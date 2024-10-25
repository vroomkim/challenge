# Turnstile

Blog의 내용을 구현한 내용입니다.
Turnstile로 Pre-Clearance를 합니다.

## WAF Rules

### Pre-Clearance Test
(http.host eq "gcp.stephenkim.site" and starts_with(http.request.uri.path, "/tapi"))

Action: managed challenge 

# Login

Challenge를 사용한 데모입니다.

Worker로 `__CF_TOKEN__`을 발행하고 API 호출 시 CF에서 이를 verify합니다.

## WAF Rules
### protect login page
(
  (http.host eq "gcp.stephenkim.site" and starts_with(http.request.uri.path, "/login") ) and 
  (cf.bot_management.score <= 99   )
)

Action: managed challenge or interactive challenge

### veryfy token
(http.host eq "gcp.stephenkim.site" and starts_with(http.request.uri.path, "/api/")
and
  ( 
     not is_timed_hmac_valid_v0(
      "testkeysample",
      concat(http.request.cookies["__cf_bm"][0],http.request.cookies["__CF_TOKEN__"][0]),
      86400, http.request.timestamp.sec,0) 
   )
)

Action: Block with response code 412
