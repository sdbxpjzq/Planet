

## Trait

是一种实现代码复用的方式.

不能实例化

`traint`中的方法可以是`public`,`protected`,`private`

```php

trait Demo
{
    public static function hello1()
    {
        return 'hello1';
    }
}


```

## 优先级

1. 若当前类中有和`Trait`中相同的方法,并不是从父类继承过来的,这时相当于方法重新. 
2. 若当前类中有和`Trait`中相同的方法,并且是从父类继承过来的,这时`Trait`的优先级高.

```php
class Animal
{
    use Demo;
    public $name = '';
    public function __construct()
    {
       echo self::hello();  // 'zongqi'
    }

    private static function hello()
    {
        return 'zongqi';
    }
}


```

继承关系

```php
class AHello
{
    protected static function hello()
    {
        return 'zongqi';
    }
}

class Animal extends AHello  // 继承
{
    use Demo;
    public $name = '';
    public function __construct($name = 'xx')
    {
       echo self::hello();  // hello
    }
}
new Animal;
```

