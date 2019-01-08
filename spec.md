# CCU PLUS Authentication Package Spec

Provide API for core module to authenticate user for National Chung Cheng University students and alumnus.

## Spec Versoin

0.0.1 (2019/01/08)

## Entry Points
The following entry points should be supported by this package.

- Portal - https://portal.ccu.edu.tw
- Alumni - https://miswww1.ccu.edu.tw/alumni/alumni/index.php
- Ecourse - https://ecourse.ccu.edu.tw

## API Spec

### sign-in

sign in current user to specific entry point

#### method parameters

|  field   |      type      | required | default |                            remark                            |
| :------: | :------------: | :------: | :-----: | :----------------------------------------------------------: |
| username |     string     |    ✓     |    -    |              student id or identity card number              |
| password |     string     |    ✓     |    -    |                              -                               |
|  target  | string \| null |    -     |  null   | target entry point for authentication, detect automatically by username when it is null |

#### method return value

- success - `GuzzleHttp\Cookie\CookieJarInterface`
- failure - `false`

#### exceptions

- `BadMethodCallException` - method parameters are missing or incorrect target value
- `RuntimeException` - network error or target entry point is not available

### sign-out

sign out user for specific entry point

#### method parameters

| field  |                  type                  | required | default | remark |
| :----: | :------------------------------------: | :------: | :-----: | :----: |
| cookie | `GuzzleHttp\Cookie\CookieJarInterface` |    ✓     |    -    |   -    |

#### method return value

- success - `true`
- failure - `false`

#### exceptions

- `BadMethodCallException` - method parameters are missing
- `RuntimeException` - network error or target entry point is not available

