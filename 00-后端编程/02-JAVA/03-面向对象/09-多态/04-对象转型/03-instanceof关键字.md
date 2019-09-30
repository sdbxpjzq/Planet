如何才能知道一个父类引用的对象,  本来是什么子类?

```
对象名称 instanceof 类名称
```

返回`boolean`值, 判断前边的对象 能不能 当做后边类的实例

```java
public static void main(String[] args) {
	Animal animal = new Cat();
  animal.eat();// 猫吃鱼
  
  // 判断是不是 猫
  if(animal  instanceof Cat) {
    Cat cat = (Cat)animal;
    cat.catHouse();
  }
    // 判断是不是 狗
  if(animal  instanceof Dog) {
    Dog dog = (Dog)animal;
    dog.dogHouse();
  }
  


}

```

