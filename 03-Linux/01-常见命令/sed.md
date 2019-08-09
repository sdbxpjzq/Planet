批量替换文本内容

```
sed [option] 'sed command' filename
```

全名stream editor,流编辑器

**适用于对文本的行 内容进行处理**

![](http://ww1.sinaimg.cn/large/006tNc79ly1g4a09mgmldj31fy0d40wa.jpg)



```shell
//  Str替换成 String
// -i 写入文件, s 字符串处理
sed -i 's/^Str/String/' replace.java

// Jack 替换成me  
// g 全局匹配
sed -i 's/Jack/me/g' replace.java

//删除空行
// d-删除
sed -i '/^ *$/d' replace.java
```















