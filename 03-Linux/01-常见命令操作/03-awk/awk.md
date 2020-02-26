对文件内容做统计

```
awk [options] 'cmd' file
```

一次读取一行文本, 默认按输入分隔符进行切片, 切成多个组成部分.

将切片直接保存在内建的变量中, `$1, $2... ($0 表示行的全部)`

支持对单个切片的判断, 支持循环判断, 默认分隔符为空格.

```shell
// 第一列 是tcp, 第二列是 1
awk '$1=="tcp" && $2==1{print $0}' netstat.txt
// NR 增加表头
awk '$1=="tcp" && $2==1 || NR==1 {print $0}' netstat.txt
// -F 使用指定的分隔符 分隔
awk -F ',' '{print $2}' test.txt
```

```
awk 'RN=1 || /正则表达式/{print $0}' 1.log

awk '{if（$5==502） print $11}' | sort | uniq -c
```









![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1g49zuhylakj31f80f4gsh.jpg)

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1g49zxl0oo2j31fq0cw0ye.jpg)

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1g49zxvm9b9j31fi0n4dln.jpg)



















