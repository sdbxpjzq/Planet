随着服务器的运行, AOF文件的内容会越来越多. 为了解决AOF文件体积膨胀的问题, 

```
auto-aof-rewrite-percentage 100
auto-aof-rewrite-min-size 64mb
```



如果aof文件`大于64M`, fork一个新的进程来进行重写

