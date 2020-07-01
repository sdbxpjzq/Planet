## IOC(Inversion of Control)- 控制反转

控制反转， 是一个理论，概念，思想。

控制： 创建对象，对象的属性赋值，对象之间的关系管理。
反转： 把原来的开发人员管理，创建对象的权限转移给代码之外的容器实现。 由容器代替开发人员管理对象。创建对象，
        给属性赋值。

正转：由开发人员在代码中，使用new 构造方法创建对象， 开发人员主动管理对象。

```java
public static void main(String args[]){
   Student student = new Student(); // 在代码中， 创建对象。--正转。
}
```



