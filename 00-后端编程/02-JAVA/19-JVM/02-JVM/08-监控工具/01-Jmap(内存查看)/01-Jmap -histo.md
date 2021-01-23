### 实例个数以及占用内存大小

```
jmap -histo 13988 > ./log.txt

num:序号
instances:实例数量
bytes:占用空间大小
class name:类名称，[C is a char[]，[S is a short[]，[I is a int[]，[B is a byte[]，[[I is a int[][]
```

![](https://youpaiyun.zongqilive.cn/image/20210117171423.png)