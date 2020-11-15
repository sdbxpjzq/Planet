## 安装

```shell
# 编译 redis-6.x，要求 C11 编译器，
yum -y install centos-release-scl
yum -y install devtoolset-9-gcc devtoolset-9-gcc-c++ devtoolset-9-binutils

#临时有效，退出 shell 或重启会恢复原 gcc 版本
scl enable devtoolset-9 bash
#长期有效
echo "source /opt/rh/devtoolset-9/enable" >>/etc/profile

wget http://download.redis.io/releases/redis-6.0.9.tar.gz
tar -zxf redis-6.0.9.tar.gz
cd redis-6.0.9
make
# 最终会安装到/usr/local/redis目录下
cd redis-6.0.9/src
make install PREFIX=/usr/local/redis
# 移动配置文件
mkdir /usr/local/redis/etc
cd redis-6.0.9/
cp redis.conf  /usr/local/redis/etc/

# 将redis-cli、redis-server命令拷贝到/usr/local/bin目录下，让这两个命令可以在任意目录下直接使用
cp /usr/local/redis/bin/redis-server /usr/local/bin/
cp /usr/local/redis/bin/redis-cli /usr/local/bin/

# 启动
/usr/local/redis/bin/redis-server /usr/local/redis/etc/redis.conf
# 或者
redis-server /usr/local/redis/etc/redis.conf 

# 停止
pkill redis
#或者
pkill redis-server

# 查看是否启动
ps -ef | grep redis
```

配置文件调整

```shell
# 后台启动
daemonize yes
# 允许来的请求
bind 0.0.0.0
# 启用密码
requirepass foobared
port 6379
```



## 集群搭建

 　Redis集群中要求奇数节点，所以至少要有三个节点，并且每个节点至少有一备份节点，所以至少需要6个redis服务实例。

```

port  7000                                        //端口7000,7002,7003        
bind 本机ip                                       //不知道0.0.0.0行不行
daemonize    yes                               //redis后台运行
pidfile  /var/run/redis_7000.pid          //pidfile文件对应7000,7001,7002
cluster-enabled  yes
protected-mode no
dbfilename dump-6379.rdb 
cluster-config-file nodes.conf
```



创建6个配置文件, 端口不一样, 分别启动6个实例

```shell
# 将7000-7005的六台服务器组成一个集群 其中复制因子为1所,以会有3台master,另外3台为slave。 16384个slot会尽可能均匀的指派给3台master, 而3台slave异步的从其master进行复制。

114.215.137.142

# IP 一定是要连接的ip
redis-cli --cluster create 127.0.0.1:6379 127.0.0.1:6378 127.0.0.1:6377 127.0.0.1:6376 127.0.0.1:6375 127.0.0.1:6374 --cluster-replicas 1 -a 密码

```



验证

```shell
redis-cli -c -p 6379
auth 密码
cluster nodes
set qwe 111
exit


redis-cli -c -p 6378
auth 密码
get qwe
```













