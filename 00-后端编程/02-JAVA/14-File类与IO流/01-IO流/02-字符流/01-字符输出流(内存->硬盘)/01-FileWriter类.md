

![](https://pic.superbed.cn/item/5e09e45476085c3289bc4592.jpg)



写出单个字符到文件

```java
public class FWWrite {
  public static void main(String[] args) throws IOException {
    // 使用文件名称创建流对象
    FileWriter fw = new FileWriter("fw.txt");     
    // 写出数据
    fw.write(97); // 写出第1个字符
    fw.write('b'); // 写出第2个字符
    fw.write('C'); // 写出第3个字符
    fw.write(30000); // 写出第4个字符，中文编码表中30000对应一个汉字。

    /*
        【注意】关闭资源时,与FileOutputStream不同。
      	 如果不关闭,数据只是保存到缓冲区，并未保存到文件。
        */
    fw.close();
  }
}
输出结果：
  abC田
```

写出字符数组:

```java
public class FWWrite {
  public static void main(String[] args) throws IOException {
    // 使用文件名称创建流对象
    FileWriter fw = new FileWriter("fw.txt");     
    // 字符串转换为字节数组
    char[] chars = "黑马程序员".toCharArray();

    // 写出字符数组
    fw.write(chars); // 黑马程序员

    // 写出从索引2开始，2个字节。索引2是'程'，两个字节，也就是'程序'。
    fw.write(b,2,2); // 程序

    // 关闭资源
    fos.close();
  }
}
```

