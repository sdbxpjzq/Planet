检索内容.

```
grep [options] pattern file
```

查找文件里符合条件的字符串

栗子:

```shell
grep "moo"  traget_file #  查找target_file 文件中 moo所在的行
grep 'partial\[true\]'  test.log  : 查找出符合的行
grep -o 'engine\[[0-9a-z]*\]' : 输出特定数据
grep -v 'grep' : 过滤掉自身
```





