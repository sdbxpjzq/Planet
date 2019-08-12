```php
resource popen ( string command, string mode )
```

描述：打开一个指向进程的管道，该进程由派生给定的 command 命令执行而产生。 返回一个和 fopen() 所返回的相同的文件指针，只不过它是单向的（只能用于读或写）并且必须用 pclose() 来关闭。此指针可以用于 fgets()，fgetss() 和 fwrite()。
例子：

```php

$fd = popen("command", 'r'); $ret = fgets($fd);

```

注意：只能打开单向管道，不是'r'就是'w'；并且需要使用pclose()来关闭。

