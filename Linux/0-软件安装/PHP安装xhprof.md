## 安装 

```shell
https://github.com/longxinH/xhprof/archive/master.zip

phpize
./configure --enable-xhprof
make
make test
sudo make install

yum -y install libjpeg freetype freetype-devel libjpeg-devel liberation-sans-fonts.noarch 

yum -y install graphviz
yum -y install 'graphviz-php*'

```

在`php.ini`中添加配置`extension=xhprof.so`. 重启服务.

执行`php -m | grep xhprof`,可以看见输出 , 说明安装成功

## 设置域名

比如做一个虚拟域名 dev.xhprof.com
绑定到xhprof的站点根目录 /usr/local/xhprof-0.9.4/xhprof_html





