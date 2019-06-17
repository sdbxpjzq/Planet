```php

$A = "PHPlinux";
$B = "PHPLinux";

$C = strstr($A, 'L');// 首次出现的位置 -- 结尾 的字符串
$D = stristr($B, 'l'); // 忽略大小写的 strstr
//echo $C .' is ' .$D; // is Linux
```

