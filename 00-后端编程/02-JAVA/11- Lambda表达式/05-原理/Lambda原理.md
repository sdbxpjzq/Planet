```java
public class LambdaDemo {
    public static void main(String[] args) {
        new Thread(()-> System.out.println("this is a lambda demo"));
    }
}
```



![](https://youpaiyun.zongqilive.cn/image/20210307192123.png)



Lambda表达式被封装成主类的私有方法