检索内容.

```
grep [options] pattern file
```

### 选项

```
-a --text  # 不要忽略二进制数据。
-A <显示行数>   --after-context=<显示行数>   # 除了显示符合范本样式的那一行之外，并显示该行之后的内容。
-b --byte-offset                           # 在显示符合范本样式的那一行之外，并显示该行之前的内容。
-B<显示行数>   --before-context=<显示行数>   # 除了显示符合样式的那一行之外，并显示该行之前的内容。
-c --count    # 计算符合范本样式的列数。
-C<显示行数> --context=<显示行数>或-<显示行数> # 除了显示符合范本样式的那一列之外，并显示该列之前后的内容。
-d<进行动作> --directories=<动作>  # 当指定要查找的是目录而非文件时，必须使用这项参数，否则grep命令将回报信息并停止动作。
-e<范本样式> --regexp=<范本样式>   # 指定字符串作为查找文件内容的范本样式。
-E --extended-regexp             # 将范本样式为延伸的普通表示法来使用，意味着使用能使用扩展正则表达式。
-f<范本文件> --file=<规则文件>     # 指定范本文件，其内容有一个或多个范本样式，让grep查找符合范本条件的文件内容，格式为每一列的范本样式。
-F --fixed-regexp   # 将范本样式视为固定字符串的列表。
-G --basic-regexp   # 将范本样式视为普通的表示法来使用。
-h --no-filename    # 在显示符合范本样式的那一列之前，不标示该列所属的文件名称。
-H --with-filename  # 在显示符合范本样式的那一列之前，标示该列的文件名称。
-i --ignore-case    # 忽略字符大小写的差别。
-l --file-with-matches   # 列出文件内容符合指定的范本样式的文件名称。
-L --files-without-match # 列出文件内容不符合指定的范本样式的文件名称。
-n --line-number         # 在显示符合范本样式的那一列之前，标示出该列的编号。
-P --perl-regexp         # PATTERN 是一个 Perl 正则表达式
-q --quiet或--silent     # 不显示任何信息。
-R/-r  --recursive       # 此参数的效果和指定“-d recurse”参数相同。
-s --no-messages  # 不显示错误信息。
-v --revert-match # 反转查找。
-V --version      # 显示版本信息。   
-w --word-regexp  # 只显示全字符合的列。
-x --line-regexp  # 只显示全列符合的列。
-y # 此参数效果跟“-i”相同。
-o # 只输出文件中匹配到的部分。
-m <num> --max-count=<num> # 找到num行结果后停止查找，用来限制匹配行数
```

### 规则表达式

```
^    # 锚定行的开始 如：'^grep'匹配所有以grep开头的行。    
$    # 锚定行的结束 如：'grep$' 匹配所有以grep结尾的行。
.    # 匹配一个非换行符的字符 如：'gr.p'匹配gr后接一个任意字符，然后是p。    
*    # 匹配零个或多个先前字符 如：'*grep'匹配所有一个或多个空格后紧跟grep的行。    
.*   # 一起用代表任意字符。   
[]   # 匹配一个指定范围内的字符，如'[Gg]rep'匹配Grep和grep。    
[^]  # 匹配一个不在指定范围内的字符，如：'[^A-FH-Z]rep'匹配不包含A-R和T-Z的一个字母开头，紧跟rep的行。    
\(..\)  # 标记匹配字符，如'\(love\)'，love被标记为1。    
\<      # 锚定单词的开始，如:'\<grep'匹配包含以grep开头的单词的行。    
\>      # 锚定单词的结束，如'grep\>'匹配包含以grep结尾的单词的行。    
x\{m\}  # 重复字符x，m次，如：'0\{5\}'匹配包含5个o的行。    
x\{m,\}   # 重复字符x,至少m次，如：'o\{5,\}'匹配至少有5个o的行。    
x\{m,n\}  # 重复字符x，至少m次，不多于n次，如：'o\{5,10\}'匹配5--10个o的行。   
\w    # 匹配文字和数字字符，也就是[A-Za-z0-9]，如：'G\w*p'匹配以G后跟零个或多个文字或数字字符，然后是p。   
\W    # \w的反置形式，匹配一个或多个非单词字符，如点号句号等。   
\b    # 单词锁定符，如: '\bgrep\b'只匹配grep。  
```

### grep命令常见用法

### 多个匹配条件-同时满足
```shell script
grep pattern1 files | grep pattern2 //显示既匹配 pattern1 又匹配 pattern2 的行

cat log.txt | grep 条件一 | grep 条件二 | grep 条件三

```
### 多个匹配条件-满足其中一个
```shell script
grep -E "key1|key2|key3" fileName
cat fileName | grep -E "key1|key2|key3"

```

### 排除(忽略)某个关键字
需要转义"|"：
```shell script
grep -v 'mmm\|nnn' abc.txt // 排除 abc.txt 中的 mmm nnn
ifconfig | grep inet | grep -v inet6 // 找到所需要的 ip 地址,使用 grep -v 屏蔽掉 inet6

```

### 不区分大小写 , 查找多个文件, 标记颜色

```shell script
grep -i "match_pattern" file_1 file_2 file_3 ...  --color=auto
```

### 结合`tail -f`使用

```shell
// grep当带上了 --line-buffer 的时候，每输出一行，就刷新一次。
tail -f adal.log| grep  -i "getActList" --line-buffered --color=auto 
```

### 查看路径下哪些文件包含`getActList`,`rn`递归查找

```shell
grep -irn "getActList"  /home/work/log/adal/ --color=auto 
```



查看指定内容上下几行

```
grep -10 ‘123’ test.log//打印匹配行的前后10行 
grep -C 10 ‘123’ test.log//打印匹配行的前后10行 
grep -A 10 -B 10 ‘123’ test.log //打印匹配行的前后10行

grep -A 10 ‘123’ test.log //打印匹配行的后10行

grep -B 10 ‘123’ test.log//打印匹配行的前10行
```

搜索行数

```shell
grep 参数 文件名 | wc- l    //查看符合条件的有多少行
cat /data/weblogs/xxx.access.log  |grep "GET /pixel.jpg?"|wc -l

```

**查询每个ip出现的次数**

```
grep -E -o "(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)"  xxx.log |sort|uniq -c

```

**模糊匹配ip**

```
grep -E -o "([0-9]{1,3}[\.]){3}[0-9]{1,3}" xxx.log|wc -l

```





查找文件里符合条件的字符串

栗子:

```shell
grep "moo"  traget_file #  查找target_file 文件中 moo所在的行
grep 'partial\[true\]'  test.log  : 查找出符合的行
grep -o 'engine\[[0-9a-z]*\]' : 输出特定数据
grep -v 'grep' : 过滤掉自身
```

**[grep参考](https://wangchujiang.com/linux-command/c/grep.html)**



参考吧  

```
tail -f test.log | grep "mode" | awk '{print $5}'命令

或者 tail -f test.log | awk '/mode/ {print $5}'的时候，如果test.log中满足模式mode的数据很少，会发现即便是test.log中新出现了满足mode的行，但是上面两个命令都没有任何输出。

原因在于grep和awk处于效率的考量，会缓存一批数据再输出到标准输出。

grep的--line-buffered选项和awk的fflush(stdout)命令可以使得grep和awk不缓存数据。如：

tail -f test.log | grep --line-buffered "mode" | awk '{print $5}'

tail -f test.log | awk '/mode/ {print $5,$6; fflush(stdout)}''
```







