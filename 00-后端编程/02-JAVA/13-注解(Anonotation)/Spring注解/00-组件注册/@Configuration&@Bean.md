![](https://youpaiyun.zongqilive.cn/image/20200226153904.png)



```java
public class MainTest {
    public static void main(String[] args) {
      // IOC 容器
        AnnotationConfigApplicationContext applicationContext =
                new AnnotationConfigApplicationContext(MainConfig.class);
        Person bean = applicationContext.getBean(Person.class);
        System.out.println(bean); // Person(age=30, name=lisi)

        String[] beanNamesForType = applicationContext.getBeanNamesForType(Person.class);
        for (String s : beanNamesForType) {
            System.out.println(s); //lisi
        }
    }
}
```







