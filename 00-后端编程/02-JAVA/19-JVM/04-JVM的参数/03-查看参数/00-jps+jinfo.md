## 查看某个参数

使用`jps -l`配合`jinfo -flag JVM参数 pid` 。先用`jsp -l`查看java进程，选择某个进程号。

![](https://youpaiyun.zongqilive.cn/image/20200424092735.png)

## 查看**所有**参数

使用`jps -l`配合`jinfo -flags pid`可以查看所有参数。





## 查看**修改**后的参数

使用`java -XX:+PrintFlagsFinal`可以查看修改后的参数，只是修改过后是`:=`而不是`=`。

### 

















































