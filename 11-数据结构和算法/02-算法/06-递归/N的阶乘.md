## 递归法计算

```php
function A($n) {
    if ($n <= 1) {
        return 1;
    }
    return $n * A($n - 1);
}
```

## 迭代法计算

```php
function A($n) {
  int result = 1;

 while( n > 1 ){
  result *= n;
  n -= 1;
 }
 return result;
}
```

