[echo指令参考](https://github.com/openresty/echo-nginx-module#content-handler-directives)

```
cd opt/
wget https://github.com/openresty/echo-nginx-module/archive/v0.61.tar.gz
$ tar zxvf v0.61.tar.gz
```

查看当前编译选项:

```
nginx -V
```

追加编译命令

```
--add-module=/opt/echo-nginx-module-0.61
```

之后执行

```
make
make install
```

nginx配置文件

```
location =  / {
  	echo "规则A";
  }
```

测试

````
curl http://127.0.0.1
````

