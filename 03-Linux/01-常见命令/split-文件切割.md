Linux中的文件，特别是日志文件，特别大了不好打开，可以用split命令来切割成小文件.

split命令有两种方式：

1，指定行数来切割

```
// 每个文件300行
split -l 300 log.txt newfile
```

2，指定文件大小来切割

```
split -b 500m log.txt newfile
```

每个文件大小500m，生成的新文件的文件名是newfile后面加上按照aa，ab，ac……来排序的

比如log.txt文件有1.4G，那么会切割出3个文件，文件名分别是newfileaa，newfileab，newfileac，没有扩展名

新文件名可以不设置，系统默认新文件以字母x开头，也就是说，如果命令是:

```
split -b 500m log.txt
```

那么文件名就是xaa，xab，xac