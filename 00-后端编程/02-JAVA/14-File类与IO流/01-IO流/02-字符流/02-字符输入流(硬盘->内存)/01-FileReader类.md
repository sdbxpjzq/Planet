![](https://pic.superbed.cn/item/5e09e06376085c3289ba7ae1.jpg)



```java
public class FileReaderConstructor throws IOException{
  public static void main(String[] args) {
    // 使用File对象创建流对象
    File file = new File("a.txt");
    FileReader fr = new FileReader(file);

    // 使用文件名称创建流对象
    FileReader fr = new FileReader("b.txt");
  }
}
```



## 读取字符数据

一个一个读取

```java
public class FRRead {
  public static void main(String[] args) throws IOException {
    // 使用文件名称创建流对象
    FileReader fr = new FileReader("read.txt");
    // 定义变量，保存数据
    int b ；
      // 循环读取
      while ((b = fr.read())!=-1) {
        System.out.println((char)b);
      }
    // 关闭资源
    fr.close();
  }
}
输出结果：
  黑
  马
  程
  序
  员
```

多个读取:

```java
public class FISRead {
  public static void main(String[] args) throws IOException {
    // 使用文件名称创建流对象
    FileReader fr = new FileReader("read.txt");
    // 定义变量，保存有效字符个数
    int len ；
      // 定义字符数组，作为装字符数据的容器
      char[] cbuf = new char[2];
    // 循环读取
    while ((len = fr.read(cbuf))!=-1) {
      System.out.println(new String(cbuf,0,len));
    }
    // 关闭资源
    fr.close();
  }
}

输出结果：
  黑马
  程序
  员
```







