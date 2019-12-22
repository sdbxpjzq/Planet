## sort

`public static <T> void sort(List<T> list, Comparator<? super T> c)`

默认升序

也可以实现自定义排序规则

```java
public static void main(String[] args) {
  List<Integer> demo = new ArrayList<>();
  Collections.addAll(demo, 20, 1, 5, 9, 4);
  Collections.sort(demo);
 System.out.println(demo); // 默认升序 [1, 4, 5, 9, 20]
}
```

## 自定义排序

## Comparator 和 Comparable

`Comparator`: 相当于 找一个第三方裁判,  比较两个

`Comparable`: 自己(this)和别人(参数)比较, 自己需要实现`Comparable接口`, 重写比较的规则`compareTo方法`

### Comparator

```java
public static void main(String[] args) {
  List<Integer> demo = new ArrayList<>();
  Collections.addAll(demo, 20, 1, 5, 9, 4);

  Collections.sort(demo, new Comparator<Integer>() {
    @Override
    public int compare(Integer o1, Integer o2) {
      //return o1-o2;// 升序 // [1, 4, 5, 9, 20]
      return o2-o1;// 降序 // [20, 9, 5, 4, 1]
    }

    @Override
    public boolean equals(Object obj) {
      return false;
    }
  });

  System.out.println(demo);

}

```

## Comparable

Person

```java
public class Person implements Comparable<Person> { // 实现接口
  private String name;
  private int age;

  public Person(String name, int age) {
    this.name = name;
    this.age = age;
  }

  public String getName() {
    return name;
  }

  public void setName(String name) {
    this.name = name;
  }

  public int getAge() {
    return age;
  }

  public void setAge(int age) {
    this.age = age;
  }

  @Override
  public String toString() {
    return "Person{" +
      "name='" + name + '\'' +
      ", age=" + age +
      '}';
  }

  @Override
  public int compareTo(Person o) { // 实现方法
//        return 0; 默认元素都是相同的
//        return this.age - o.age;// 升序
        return o.age - this.age;// 降序
  }
}

```

```java
Person person1 = new Person("demo1", 18);
Person person2 = new Person("deo02", 30);
Person person3 = new Person("demo3", 25);

ArrayList<Person> people = new ArrayList<>();
Collections.addAll(people, person1, person2, person3);
Collections.sort(people);
System.out.println(people);
// 结果:
// [Person{name='deo02', age=30}, Person{name='demo3', age=25}, Person{name='demo1', age=18}]
```



























































