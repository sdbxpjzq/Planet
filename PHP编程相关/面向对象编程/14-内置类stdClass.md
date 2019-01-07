## php内置类  stdClass

如果希望数据以对象的方式存储, 同时又不想定义一个类, 可以考虑`stdClass`

```php

$o1 = new stdClass();
var_dump($o1);


// 输出
object(stdClass)#1 (0) {
}

```

