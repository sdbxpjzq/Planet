nohup 和 & 搭配到一块使用

```
nohup php test.php  >nohup2.out 2>&1 &
```



```
只输出错误信息到日志文件
nohup ./program >/dev/null 2>log &

什么信息也不要
nohup http-server >/dev/null 2>&1 &
```

