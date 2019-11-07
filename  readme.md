# JapanNengo
Convert Western Calendar to Japan Calendar.
E.g:
- 1989/01/02 ⇒ 昭和64年01月02日
- 2019/04/30 ⇒ 平成31年04月30日
- 2019/05/01 ⇒ 令和1年05月01日

# Installation
## Composer
```
composer require namtenten/japan-nengo
```

# Usage

```php
<?php

require 'vendor/autoload.php';
use NamTenTen\JapanNengo;

$nengo = new JapanNengo();
$nengo_year = $nengo->toNengoYear("2019/04/30");
echo $nengo_year . "\n";

$nengo_array = $nengo->toNengoArray("2019/11/07");
var_dump($nengo_array)
echo "\n";
```
