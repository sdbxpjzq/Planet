## parse_url

```php

$info = parse_url('https://xxx/details/78903932.html?id=1212#ttt');
print_r($info);
/*
Array
(
    [scheme] => https
    [host] => xxx
    [path] => /details/78903932.html
    [query] => id=1212
    [fragment] => ttt
)
*/

print_r(pathinfo($info['path']));
/*
Array
(
    [dirname] => /details
    [basename] => 78903932.html
    [extension] => html
    [filename] => 78903932
)
*/


```

