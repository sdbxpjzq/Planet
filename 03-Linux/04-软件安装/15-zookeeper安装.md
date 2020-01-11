

https://www.apache.org/dyn/closer.cgi/zookeeper/

```shell
wget http://ftp.cuhk.edu.hk/pub/packages/apache.org/zookeeper/zookeeper-3.5.6/apache-zookeeper-3.5.6-bin.tar.gz
tar -zxvf apache-zookeeper-3.5.6.bin.tar.gz
rename apache-zookeeper-3.5.6.bin zookeeper-3.5.6 apache-zookeeper-3.5.6

mv ./zookeeper-3.5.6 /usr/local
cd /usr/local/zookeeper-3.5.6/
# 创建data目录,存放zookeeper的一些配置等文件
mkdir data

cd conf
cp zoo_sample.cfg zoo.cfg
vi zoo.cfg
dataDir=/usr/local/zookeeper-3.5.6/data

启动
/usr/local/zookeeper-3.4.13/bin
./zkServer.sh start
查看zookeeper状态
/usr/local/zookeeper-3.4.13/bin/zkServer.sh status

开放2181端口
因为zookeeper默认的是2181端口号，为了能对外正常访问zookeeper，需要开放2181端口号，或者关闭防火墙;



```



## 集群配置

