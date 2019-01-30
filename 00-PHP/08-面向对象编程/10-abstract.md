## 抽象类

只要类里面有一个方法是**抽象方法**，那么这个类就要定义为抽象类。

抽象的类不能被实例化.

若一个类继承了抽象类, 则该类必须把 抽象类的所有抽象方法全部实现, 除非自己也是一个抽象类.

```php
abstract class Animal
{
    protected $name = '';
    public function __construct($name = 'xx')
    {
        $this->name = $name;
    }

     abstract public function voice();
}
```







## 抽象方法

