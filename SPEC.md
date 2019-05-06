# CCU PLUS Authentication Package Spec

Provide API for core module to authenticate user for National Chung Cheng University students and alumnus.

## Spec Version

0.0.2 (2019/05/06)

## Entry Points
The following entry points should be supported by this package.

- Portal - https://portal.ccu.edu.tw
- Alumni - https://miswww1.ccu.edu.tw/alumni/alumni/index.php

## API Spec

### sign-in

sign in current user to specific entry point

#### method parameters

|  field   |  type  | required | default |                 remark                |
| :------: | :----: | :------: | :-----: | :-----------------------------------: |
| username | string |    ✓     |    -    |   student id or identity card number  |
| password | string |    ✓     |    -    |                   -                   |
|  target  | string |    ✓     |    -    | target entry point for authentication |

#### method return value

- success - `GuzzleHttp\Cookie\CookieJarInterface`
- failure - `false`

#### exceptions

- `InvalidArgumentException` - invalid target value
- `GuzzleHttp\Exception\RequestException` - network error
- `GuzzleHttp\Exception\BadResponseException` - target entry point server unavailable

### sign-out

sign out user for specific entry point

#### method parameters

| field  |                  type                  | required | default | remark |
| :----: | :------------------------------------: | :------: | :-----: | :----: |
| cookie | `GuzzleHttp\Cookie\CookieJarInterface` |    ✓     |    -    |   -    |

#### method return value

- success - `true`
- failure - `false`
