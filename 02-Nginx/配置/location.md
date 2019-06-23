模式	含义
location = /uri	= 表示精确匹配，只有完全匹配上才能生效
location ^~ /uri	^~ 开头对URL路径进行前缀匹配，并且在正则之前。
location ~ pattern	开头表示区分大小写的正则匹配
location ~* pattern	开头表示不区分大小写的正则匹配
location /uri	不带任何修饰符，也表示前缀匹配，但是在正则匹配之后

location /	通用匹配，任何未匹配到其它location的请求都会匹配到，相当于switch中的default

## 匹配优先级

- 首先精确匹配 `=`
- 其次前缀匹配 `^~`
- 其次是按文件中顺序的正则匹配
- 然后匹配不带任何修饰的前缀匹配。
- 最后是交给 `/` 通用匹配



````
location = / {
   echo "规则A";
}
location = /login {
   echo "规则B";
}
location ^~ /static/ {
   echo "规则C";
}
location ^~ /static/files {
    echo "规则X";
}
location ~ \.(gif|jpg|png|js|css)$ {
   echo "规则D";
}
location ~* \.png$ {
   echo "规则E";
}
location /img {
    echo "规则Y";
}
location / {
   echo "规则F";
}
````

那么产生的效果如下：

- 访问根目录` /`，比如` http://localhost/` 将匹配 规则A
- 访问 `http://localhost/login` 将匹配 规则B，`http://localhost/register `则匹配 规则F
- 访问 `http://localhost/static/a.html` 将匹配 规则C
- 访问 `http://localhost/static/files/a.exe` 将匹配 规则X，虽然 规则C 也能匹配到，但因为最大匹配原则，最终选中了 规则X。你可以测试下，去掉规则 X ，则当前 URL 会匹配上 规则C。
- 访问` http://localhost/a.gif, http://localhost/b.jpg `将匹配 规则D 和 规则 E ，但是 规则 D 顺序优先，规则 E 不起作用，而 `http://localhost/static/c.png`则优先匹配到 规则 C
- 访问 `http://localhost/a.PNG `则匹配 规则 E ，而不会匹配 规则 D ，因为 规则 E 不区分大小写。
- 访问` http://localhost/img/a.gif` 会匹配上 规则D,虽然 规则Y 也可以匹配上，但是因为正则匹配优先，而忽略了 规则Y。



