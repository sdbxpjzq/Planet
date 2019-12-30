## 写入数据原理(内存 -> 硬盘)

java程序 --> JVM(java虚拟机) --> OS(操作系统) -> OS调用写数据方法 --> 把数据写到文件中



![](https://pic.superbed.cn/item/5e09c36176085c3289b4f683.jpg)



> 当你创建一个流对象时，必须传入一个文件路径。
>
> 该路径下，如果没有这个文件，会创建该文件。
>
> 如果有这个文件，会清空这个文件的数据。



```java
public class FileOutputStreamConstructor throws IOException {
  public static void main(String[] args) {
    // 使用File对象创建流对象
    File file = new File("a.txt");
    FileOutputStream fos = new FileOutputStream(file);

    // 使用文件名称创建流对象
    FileOutputStream fos = new FileOutputStream("b.txt");
  }
}
```

![](https://pic.superbed.cn/item/5e09c44e76085c3289b543bf.jpg)

```java
public class FOSWrite {
  public static void main(String[] args) throws IOException {
    // 使用文件名称创建流对象
    FileOutputStream fos = new FileOutputStream("fos.txt");     
    // 写出数据
    fos.write(97); // 写出第1个字节
    fos.write(98); // 写出第2个字节
    fos.write(99); // 写出第3个字节
    // 关闭资源
    fos.close();
  }
}
输出结果：
  abc
```









