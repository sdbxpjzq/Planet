

https://oneinstack.com/

```shell
yum -y install wget screen
wget http://mirrors.linuxeye.com/oneinstack-full.tar.gz
tar xzf oneinstack-full.tar.gz
cd oneinstack
screen -S oneinstack #如果网路出现中断，可以执行命令`screen -R oneinstack`重新连接安装窗口
./install.sh

```

