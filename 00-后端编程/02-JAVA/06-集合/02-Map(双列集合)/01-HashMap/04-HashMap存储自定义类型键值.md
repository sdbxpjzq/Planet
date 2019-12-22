## HashMap存储自定义类型键值

key: Persion类型

​		Person类必须重写`hashCode方法`和`equals方法`, 保证`key`唯一

value: 可以重复

```java
public class Person {
  private String name;
  private int age;

  public Person(String name, int age) {
    this.name = name;
    this.age = age;
  }

  @Override
  public boolean equals(Object o) {
    if (this == o) return true;
    if (o == null || getClass() != o.getClass()) return false;
    Person person = (Person) o;
    return age == person.age &&
      Objects.equals(name, person.name);
  }

  @Override
  public int hashCode() {
    return Objects.hash(name, age);
  }
}


```

```java
public static void main(String[] args) {
  HashMap<Person, Integer> personMap = new HashMap<>();
  // 姓名 , 年龄 一样, 看做是同一个人
  personMap.put(new Person("zongqi", 18), 100);
  personMap.put(new Person("lisi", 20), 100);
  personMap.put(new Person("zongqi", 18), 300);

  System.out.println(personMap);

}
```













