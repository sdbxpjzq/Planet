底层是一个`哈希表结构`, 查询速度非常快.

```java
public static void main(String[] args) throws ParseException {
  HashSet<Integer> i = new HashSet<>();
  i.add(1);
  i.add(2);
  i.add(3);
  print(i);
}

public static void print(Collection<?> list) {
  Iterator<?> iterator = list.iterator();
  while (iterator.hasNext()) {
    // 取出的都是Object, 可以接收任意类型的数据
    Object s = iterator.next();
    System.out.println(s);
  }
}
```



## 哈希值

是一个十进制的整数, 由系统随机给出  ( 就是对象的地址值, 是一个逻辑地址, 是模拟出来得到地址, 不是数据实际存储的物理地址)

在`Object类`中有一个方法, 获取对象的哈希值, `hashCode`方法.



## 存储结构原理

![](https://pic.superbed.cn/item/5da12a6d451253d1785bf4b7.jpg)



## 结合元素不重复原理

![](https://pic.superbed.cn/item/5da12bbd451253d1785cf7a3.jpg)



## 存储自定义类型元素

给`HashSet`中存放自定义类型元素时, 需要重写对象中的`hashCode`和`equals`方法, 建立自己的比较方式, 才能保证`HashSet`集合中的对象唯一.

```java
public class Person {
  private String name;

  public Person() {
  }

  public Person(String name) {
    this.name = name;
  }

  public String getName() {
    return name;
  }

  public void setName(String name) {
    this.name = name;
  }

  @Override
  public boolean equals(Object o) {
    if (this == o) return true;
    if (o == null || getClass() != o.getClass()) return false;
    Person person = (Person) o;
    return Objects.equals(name, person.name);
  }

  @Override
  public int hashCode() {
    return Objects.hash(name);
  }
}
```

```java
public static void main(String[] args) throws ParseException {
  Person person1 = new Person("小明");
  Person person2 = new Person("小明");

  HashSet<Person> peopleHashSet = new HashSet<>();
  peopleHashSet.add(person1);
  peopleHashSet.add(person2);

  Iterator<Person> iterator = peopleHashSet.iterator();
  while (iterator.hasNext()) {
    Person next = iterator.next();
    System.out.println(next.getName()); // 只输出一个小明
  }
}
```































