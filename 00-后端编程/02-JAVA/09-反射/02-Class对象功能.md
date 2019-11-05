# Class对象功能

## 获取成员变量

- `Field[] getFields()`  获取所有`public`修饰的成员变量名
- `Field getField(String name)`获取指定名称的`public`修饰的成员变量名

![](https://pic.superbed.cn/item/5dc15d268e0e2e3ee912026c.jpg)



- `Field[] getDeclaredFields`获取所有的成员变量, 不考虑修饰符
- `Field getDeclaredField(String name)`. 默认获取`public`修饰的成员变量, (可以使用暴力反射, 都能取到值)

```java
 public static void main(String[] args) throws Exception {
        Class<Person> personClass = Person.class;
        Field[] fields = personClass.getDeclaredFields();
        Person person = new Person();
        for (Field f :
                fields) {
            System.out.println(f);
            f.setAccessible(true); // 暴力反射
            System.out.println(f.get(person));
        }
    }
```

![](https://pic.superbed.cn/item/5dc15d628e0e2e3ee91208ba.jpg)



## Constructor构造方法

创建对象: `T  newInstance(Object... initargs)`

如果使用`空参数构造`方法创建对象, 操作可以简化: `Class对象的newInstance`方法

有参数构造:

```java
Class<Person> personClass = Person.class;
Constructor<Person> constructor = personClass.getConstructor(String.class, int.class);
Person zongqi = constructor.newInstance("zongqi", 27);
System.out.println(zongqi);
```

无参数构造(简化写法):

```java
Class<Person> personClass = Person.class;
Person lisi = personClass.newInstance();
System.out.println(lisi);
```

## Method: 方法对象

### 获取方法名

- `Method[]  getMethods()` : getMethods 获取的public 权限的方法, 也包括其父类的 方法(默认 `Object`)
- `Method getMethod(String name, Class<?>... parameterTypes)`:  第二个参数是: 参数类型

```java
public void method1(int age) {}
public void method1(String name) {}
```

```java
Method[] methods = personClass.getMethods();
for (Method m:
     methods) {
  System.out.println(m);
}

Method method1 = personClass.getMethod("method1", String.class); // 指定参数类型
System.out.println(method1);
```



- `Method[]  getDeclaredFields()`: 不管是什么修饰符, 都能取到
- `Method getDeclaredMethod(String name, Class<?>... parameterTypes)`: 不管是什么修饰符, 都能取到

```java
private void privateMethod() {}
public void method1(int age) {}
public void method1(String name) {}
```

```java
Method[] declaredMethods = personClass.getDeclaredMethods();
Method method = personClass.getDeclaredMethod("privateMethod");
System.out.println(method);
```

### 执行方法

- 执行方法: `Object invoke(Object obj, Object... args)`

```java
private void privateMethod() {
  System.out.println(11);
}

public void method1(int age) {
  System.out.println(age);
}
public void method1(String name) {
  System.out.println(name);
}
```



```java
Method method1 = personClass.getDeclaredMethod("method1", String.class);
Method privateMethod = personClass.getDeclaredMethod("privateMethod");
Person person = new Person();
// method1 是public修饰, 直接执行
method1.invoke(person, "zongqi");
//privateMethod 是private修饰, 需要暴力反射
privateMethod.setAccessible(true);
privateMethod.invoke(person);
```



## 获取全类名

-  `String getName()`

```java
String name = personClass.getName();
System.out.println(name); // zong.java05.Person
```































































