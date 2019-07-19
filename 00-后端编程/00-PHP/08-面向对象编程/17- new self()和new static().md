self - 就是这个类，是代码段里面的这个类。

static - PHP 5.3加进来的只得是当前这个类，有点像$this的意思，从堆内存中提取出来，访问的是当前实例化的那个类，那么 static 代表的就是那个类。

```php
class A {
  public static function get_self() {
    return new self();
  }

  public static function get_static() {
    return new static();
  }
}

class B extends A {}

echo get_class(B::get_self()); // A
echo get_class(B::get_static()); // B
echo get_class(A::get_static()); // A


```

