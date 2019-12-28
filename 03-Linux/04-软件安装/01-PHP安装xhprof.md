## 安装 

```shell
wget https://github.com/longxinH/xhprof/archive/master.zip
unzip master/extension/
phpize
./configure --enable-xhprof
make
make test
sudo make install

yum -y install libjpeg freetype freetype-devel libjpeg-devel liberation-sans-fonts.noarch 

yum -y install graphviz
yum -y install 'graphviz-php*'

```

在`php.ini`中添加配置

```
extension=xhprof.so;

// 不设置目录的话 ,放在 sys_get_temp_dir临时目录
;xhprof.output_dir=/var/tmp/xhprof 
```

执行`php -m | grep xhprof`,可以看见输出 , 说明安装成功.

## 设置域名

将`xhprof_html`和`xhprof_lib`拷贝到nginx的root目录

```
listen 83;
  server_name www.aa.com;
  index index.html index.htm index.php;
  root /data/wwwroot/www.aa.com/xhprof_html;

  include /usr/local/nginx/conf/rewrite/none.conf;
  #error_page 404 /404.html;
  #error_page 502 /502.html;
  location = / {
          index index.php;
  }

  location ~ [^/]\.php(/|$) {
    #fastcgi_pass remote_php_ip:9000;
    fastcgi_pass unix:/dev/shm/php-cgi.sock;
    fastcgi_index index.php;
    include fastcgi.conf;
  }
```

## 使用

```php
// 文件开始
$xhprof_data = \xhprof_enable();
 要检测的文件
   
   
//  结束分析
$xhprof_data = xhprof_disable();
require_once '/data/wwwroot/www.aa.com/xhprof_lib/utils/xhprof_lib.php';
require_once '/data/wwwroot/www.aa.com/xhprof_lib/utils/xhprof_runs.php';
$xhprof_runs = new XHProfRuns_Default();
$run_id = $xhprof_runs->save_run($xhprof_data, 'your_project');
// 可以设置header 方便查看
header("XHPROF-URL:http://192.168.33.10:83/index.php?run={$run_id}&source=your_project");


```



## 参数说明

    Function Name：方法名称。
    
    Calls：方法被调用的次数。
    
    Calls%：方法调用次数在同级方法总数调用次数中所占的百分比。
    
    Incl.Wall Time(microsec)：方法执行花费的时间，包括子方法的执行时间。（单位：微秒）
    
    IWall%：方法执行花费的时间百分比。
    
    Excl. Wall Time(microsec)：方法本身执行花费的时间，不包括子方法的执行时间。（单位：微秒）
    
    EWall%：方法本身执行花费的时间百分比。
    
    Incl. CPU(microsecs)：方法执行花费的CPU时间，包括子方法的执行时间。（单位：微秒）
    
    ICpu%：方法执行花费的CPU时间百分比。
    
    Excl. CPU(microsec)：方法本身执行花费的CPU时间，不包括子方法的执行时间。（单位：微秒）
    
    ECPU%：方法本身执行花费的CPU时间百分比。
    
    Incl.MemUse(bytes)：方法执行占用的内存，包括子方法执行占用的内存。（单位：字节）
    
    IMemUse%：方法执行占用的内存百分比。
    
    Excl.MemUse(bytes)：方法本身执行占用的内存，不包括子方法执行占用的内存。（单位：字节）
    
    EMemUse%：方法本身执行占用的内存百分比。
    
    Incl.PeakMemUse(bytes)：Incl.MemUse峰值。（单位：字节）
    
    IPeakMemUse%：Incl.MemUse峰值百分比。
    
    Excl.PeakMemUse(bytes)：Excl.MemUse峰值。单位：（字节）
    
    EPeakMemUse%：Excl.MemUse峰值百分比
