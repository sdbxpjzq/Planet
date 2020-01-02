

![](https://pic.superbed.cn/item/5e0d466076085c328955c556.jpg)



```java
public class Employee implements java.io.Serializable {
  // 加入序列版本号
  private static final long serialVersionUID = 1L;
  public String name;
  public String address;
  // 添加新的属性 ,重新编译, 可以反序列化,该属性赋为默认值.
  public int eid; 

  public void addressCheck() {
    System.out.println("Address  check : " + name + " -- " + address);
  }
}
```

## 原理分析



![](https://pic.superbed.cn/item/5e0d46a476085c328955cbfd.jpg)



