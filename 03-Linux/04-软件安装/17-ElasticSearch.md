```shell
wget https://artifacts.elastic.co/downloads/elasticsearch/elasticsearch-7.5.1-linux-x86_64.tar.gz

tar -zxvf elasticsearch-7.5.1-linux-x86_64.tar.gz

mv ./elasticsearch-7.5.1 /usr/local

# elasticsearch不允许使用root启动，创建一个新的用户elastic，并为这个账户赋予相应的权限来启动elasticsearch。
groupadd elsearch
useradd zongqi -g elsearch -p zongqi
chown -R zongqi:elsearch /usr/local/elasticsearch-7.5.1

su zongqi
# 启动 -d 后台启动
/usr/local/elasticsearch-7.5.1/bin/elasticsearch 

```



## docker安装

```shell
docker search elasticsearch
docker pull elasticsearch:7.5.1
# 设置ES 占用内存大小,默认占用2G
# 9200 服务端口
# 9300 分布式下的端口
docker run -e ES_JAVA_OPTIONS="-Xms512m -Xms512m" -d -p 8400:9200 -p 8410:9300 --name myEs-1 xx



docker run -e ES_JAVA_OPTS="-Xms512m -Xmx512m"  -d -p 8400:9200 -p 8410:9300 --name myEs-2 xx
```

## 7.x版本安装注意

```shell
find /var/lib/docker/ -name elasticsearch.yml


cluster.name: "docker-cluster"
network.host: 0.0.0.0


# custom config
node.name: "node-1"
discovery.seed_hosts: ["127.0.0.1", "[::1]"]
cluster.initial_master_nodes: ["node-1"]
# 开启跨域访问支持，默认为false
http.cors.enabled: true
# 跨域访问允许的域名地址，(允许所有域名)以上使用正则
http.cors.allow-origin: /.*/ 

```

重点是 `node.name` 和 `cluster.initial_master_nodes`