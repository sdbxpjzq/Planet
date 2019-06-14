```php
function A($n) {
    if ($n <= 1) {
        return 1;
    }
    return $n * A($n - 1);
}
```

