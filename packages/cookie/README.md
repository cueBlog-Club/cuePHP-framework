# CuePhp-cookie

[![Build Status](https://github.com/cuephp/cookie/workflows/ci/badge.svg)](https://github.com/cuephp/cookie/actions)
[![Code Coverage](https://codecov.io/gh/cuephp/cookie/branch/main/graph/badge.svg)](https://codecov.io/gh/cuephp/cookie/branch/main)

[![Latest Stable Version](https://img.shields.io/packagist/v/cuephp/cookie.svg?style=flat-square)](https://packagist.org/packages/cuephp/cookie)
[![Total Downloads](https://img.shields.io/packagist/dt/cuephp/cookie.svg?style=flat-square)](https://packagist.org/packages/cuephp/cookie)


### Instanll

```
compose require cuephp/cookie
```

### Usage

#### extra from header

```php
use CuePhp\CookieManager;


$cookie = CookieManager::createFromHeaders($cookieString); // cookie string is  from http header

// get cookie value
$cookie->getValue();

```

#### Set value to Header
```php
use CuePhp\CookieManager;

$cookie = CookieManager::new( 'name', 'value' );
CookieManager::setToClientHeaders($cookie); // will set response header set-cookie

```

#### Set value With Options
```php
use CuePhp\CookieManager;
$cookie = CookieManager::new( 'name', 'value', {$options} );
```

##### options

+ expires:
+ path:
+ secure: 
+ domain:
+ httponly:
+ samesite: