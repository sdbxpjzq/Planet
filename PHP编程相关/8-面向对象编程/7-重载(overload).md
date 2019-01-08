## 重载技术

通常在面向对象的语言中,**同名方法的参数不同**.这种现象称为 "重载".

参数不同包括: 个数不同, 类型不同,顺序不同.

```php
class A
{
    int function f1(int x) {......}
    int function f1(int x, int y) {......}
    int function f1(string s, int m) {......}
}
```

> 但是,在php中, 一个class中, 不可以定义多个同名的函数. — 这是语法错误.

### 属性重载:

如果使用一个不存在的属性, 就会去自动调用类中预先定义好的某个方法, 来处理数据. `__get()`, `__set()`

### 方法重载:

如果使用一个不存在的方法, 就会去自动调用类中预先定义好的某个方法, 来处理该行为. `__call()`, `__callStatic()`

![](https://ws1.sinaimg.cn/large/006tNc79ly1fhstlxeba7j30vq0r4tam.jpg)

