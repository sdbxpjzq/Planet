底层是 `数组+链表` 的结构.

底层是一个`哈希表结构`, 查询速度非常快.



## HashSet底层是什么

```java
public HashSet() {
  map = new HashMap<>();
}

//add set 本质就是 map key是无法重复的！
public boolean add(E e) {
  return map.put(e, PRESENT)==null;
}

// Dummy value to associate with an Object in the backing Map
private static final Object PRESENT = new Object();
```

## 特点

1. 不能保证元素的排列顺序
2. `HashSet`不是线程安全的
3. 集合元素可以是`null`

## 判断两个元素相等的标准

两个对象通过`hashCode()`方法比较相等, 并且两个对象的`equlas()`方法返回值也相等

## 注意点

对于存放在`Set`容器中的对象, 对象的类一定要重写`equlas()`和`hashCode()` 方法, 以实现对象相等规则. 即: 相等的对象必须具有相等的散列码



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































