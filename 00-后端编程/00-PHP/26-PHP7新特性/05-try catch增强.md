PHP7的`try catch`可以捕获**任何错误**

```php
try {
  undefindFunc();
} catch (Error $e) {
  var_dump($e);
}
```

