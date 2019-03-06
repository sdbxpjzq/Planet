```shell
git clone git://github.com/xdebug/xdebug.git # 方法1：通过git下载最新版
wget https://xdebug.org/files/xdebug-2.5.1.tgz # 方法2：官网下载源码包

tar zvxf xdebug-2.5.1.tgz
cd xdebug-2.5.1

phpize # 生成configure文件
./configure --enable-xdebug  # 配置
make && make install # 编译并生成


cd modules/  
mkdir /usr/local/webserver/php/modules  
cp xdebug.so /usr/local/webserver/php/modules  
```

在`php.ini`中配置

```shell
zend_extension= /usr/local/webserver/php/modules/xdebug.so  
xdebug.profiler_enable=on#开启性能监控（一般在正式环境不建议开启）  
xdebug.trace_output_dir="/usr/local/webserver/php/xdebug_trace"#程序执行顺序日志  
xdebug.profiler_output_dir="/usr/local/webserver/php/xdebug_profiler"#程序执行性能日志
```

重启fpm

`service php-fpm restart`

