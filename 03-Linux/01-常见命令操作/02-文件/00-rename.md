

https://man.linuxde.net/rename

```
rename(参数)

参数:
原字符串：将文件名需要替换的字符串；
目标字符串：将文件名中含有的原字符替换成目标字符串；
文件：指定要改变文件名的文件列表。


```

将main1.c重命名为main.c

```
rename main1.c main.c main1.c
```

**rename支持通配符**

```
?  可替代单个字符
*  可替代多个字符
[charset]  可替代charset集中的任意单个字符

```

