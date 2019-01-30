1. 先判断该对象是否有这个属性, 如果有则返回`true`.
2. 如果该对象没有这个属性,  则继续判断该对象对应的`class`是否定义过这个属性, 如果定义过, 仍然返回`true`,否则返回`false`.

>  注意:  如果值是`null`, 则返回`true`.

实例:

```php

class Person
{
    public $name;
    public function __construct($name)
    {
        $this->name = 'private';
    }
}


$people1=new Person("张三");
unset($people1->name);
var_dump(property_exists($people1, 'name')); // true
var_dump(isset($people1->name)); // fasle

$people1->age = null;
var_dump(property_exists($people1, 'age')); // true

$people1->age = 100;
unset($people1->age);
var_dump(property_exists($people1, 'age')); // false

```









