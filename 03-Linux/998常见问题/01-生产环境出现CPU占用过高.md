

```java
while (true) {
  System.out.println(new Random().nextInt(77778888));
}
```



- ## 步骤1：

  先用**top**命令找出CPU占比最高的

  ![](https://youpaiyun.zongqilive.cn/image/20200427095103.png)

- ### 步骤2：

  **ps -ef** 或者 **jps** 进一步定位，得知是一个怎样的后台程序

  `ps -ef | grep 3928 |grep -v grep`

  ![](https://youpaiyun.zongqilive.cn/image/20200427095137.png)

- ## 步骤3：

  定位到具体线程或者代码
  `ps -mp 进程ID -o THREAD,tid,time`

  ```
  -o：该参数是用户自定义格式
  -p：pid进程使用cpu的时间
  -m : 显示所有线程
  ```

  ![](https://youpaiyun.zongqilive.cn/image/20200427095310.png)

  

- ## 步骤4：

  将需要的线程ID转换为16进制格式（英文小写格式）
  再使用：`printf "%x/\n"  有问题的线程ID`

  ```
  printf "%x/\n" 3929; // f59
  ```

  或者使用[转换工具](https://tool.oschina.net/hexconvert) 



- ## 步骤5：

  `jstat 进程ID | grep tid（16进制线程ID小写英文）-A60` : 打印出 前60行

  

  `jstat 3928 |grep tid  f59 -A60`

  ![](https://youpaiyun.zongqilive.cn/image/20200427095821.png)

  

  

  

  

  

  

  

  





































































