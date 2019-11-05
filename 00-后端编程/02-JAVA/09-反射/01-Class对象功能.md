# Class对象功能

## 获取成员变量

- `Field[] getFields()`  获取所有`public`修饰的成员变量名
- `Field getField(String name)`获取指定名称的`public`修饰的成员变量名



- `Field[] getDeclaredFields`获取所有的成员变量, 不考虑修饰符
- `Field getDeclaredField(String name)`. 默认获取`public`修饰的chen