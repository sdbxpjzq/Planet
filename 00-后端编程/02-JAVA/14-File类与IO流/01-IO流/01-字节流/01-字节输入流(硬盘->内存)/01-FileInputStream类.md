![](https://pic.superbed.cn/item/5e09dd8476085c3289b9caf4.jpg)



当你创建一个流对象时，必须传入一个文件路径。该路径下，如果没有该文件,会抛出`FileNotFoundException` 。



```java
public class FISRead {
  public static void main(String[] args) throws IOException{
    // 使用文件名称创建流对象.
    FileInputStream fis = new FileInputStream("read.txt"); // 文件中为abcde
    // 定义变量，作为有效个数
    int len ；
      // 定义字节数组，作为装字节数据的容器   
      byte[] b = new byte[2];
    // 循环读取
    while (( len= fis.read(b))!=-1) {
      // 每次读取后,把数组的有效字节部分，变成字符串打印
      System.out.println(new String(b，0，len));//  len 每次读取的有效字节个数
    }
    // 关闭资源
    fis.close();
  }
}

输出结果：
  ab
  cd
  e
```

> 使用数组读取，每次读取多个字节，减少了系统间的IO操作次数，从而提高了读写的效率，建议开发中使用。

