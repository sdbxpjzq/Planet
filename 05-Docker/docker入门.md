![](https://ws3.sinaimg.cn/large/006tNbRwly1fwg1evhtydj30dw0bkwes.jpg)

Docker 包括三个基本概念
镜像（Image）
容器（Container）
仓库（Repository）

# Dockerfile

demo:
```shell
FROM centos:latest
RUN groupadd -r redis && useradd  -r -g redis redis
RUN yum -y install epel-release && yum -y install redis && yum -y install net-tools
EXPOSE 6379
```

## FROM
指定基础镜像,  是必备的指令, 并且必须是第一条
## RUN 

执行命令

## EXPOSE
设置端口

## COPY 复制文件
`COPY  <源路径>  <目标路径>`
源文件的各种元数据都会保留. 比如 读, 写, 执行权限,文件变更时间

## ADD 更高级的复制文件
![](https://ws1.sinaimg.cn/large/006tNbRwly1fwg1ch1uhxj31jc0vo77w.jpg)

![](https://ws4.sinaimg.cn/large/006tNbRwly1fwg1dna83ej31g40b4dgu.jpg)

## CMD 容器启动命令
![](https://ws4.sinaimg.cn/large/006tNbRwly1fwg1ndy365j31hs0cat9f.jpg)

`CMD ["nginx", "-g", "daemon  off"]`

##  ENTRYPOINT 入口点
![](https://ws2.sinaimg.cn/large/006tNbRwly1fwg1qbbhgmj31iy0qggnq.jpg)


## ENV 设置环境变量
![](https://ws1.sinaimg.cn/large/006tNbRwly1fwg28d2f6zj31ia0nw0u4.jpg)

## ARG  构建参数
![](https://ws3.sinaimg.cn/large/006tNbRwly1fwg2ekenj5j31iu0a8my7.jpg)


## VOLUME 定义匿名卷
![](https://ws4.sinaimg.cn/large/006tNbRwly1fwg2j8r1jej30qy08sq2w.jpg)
![](https://ws2.sinaimg.cn/large/006tNbRwly1fwg2gv11c1j31ke0asgma.jpg)

## EXPOSE 声明端口
`EXPOSE   80 ` 
`EXPOSE  [80, 433]`
![](https://ws3.sinaimg.cn/large/006tNbRwly1fwg40mtqnqj31i408yjs9.jpg)

## WORKDIR  指定工作目录

![](https://ws2.sinaimg.cn/large/006tNbRwly1fwg4bh3c08j31jg16gjwk.jpg)










# 网络
`docker network ls`  查看默认的网络
 ## 类型
- bridge：桥接网络

  默认情况下启动的Docker容器，都是使用 bridge，Docker安装时创建的桥接网络，每次Docker容器重启时，会按照顺序获取对应的IP地址，这个就导致重启下，Docker的IP地址就变了

- none：无指定网络
  使用 --network=none ，docker 容器就不会分配局域网的IP

- host： 主机网络
  使用 --network=host，此时，Docker 容器的网络会附属在主机上，两者是互通的。
  例如，在容器中运行一个Web服务，监听8080端口，则主机的8080端口就会自动映射到容器中

## 自定义网络

因为默认的网络不能制定固定的地址，所以我们将创建自定义网络，并指定网段：172.10.0.0/16 并命名为mynetwork，指令

如下：
`docker network create  --subnet=172.10.0.0/16  mynetwork`

##  查看IP


# 容器

![](https://ws3.sinaimg.cn/large/006tNbRwly1fweox5d3vxj312d0473yp.jpg)

## docker run
-d: 后台运行容器，并返回容器ID；
-i: 以交互模式运行容器，通常与 -t 同时使用；
-p: 端口映射，格式为：主机(宿主)端口:容器端口
-t: 为容器重新分配一个伪输入终端，通常与 -i 同时使用；
--ip: 为容器制定一个固定的ip 
--net: 指定网络模式


## 新建容器并启动
`docker run -itd --name  redis-master  --net mynetwork  -p 6380:6379  --ip 172.10.0.2  redis `

##  常见其他命令
`docker container ls ` ,  `docker  ps`  // 查看正在运行的容器
`docker container ls   -a` // 查看所有的容器
`docker container start  <container  id >`  // 启动容器
`docker container stop  <container  id>`  // 终止容器
`docker container rm  <container id>  `   // 删除 容器

`docker inspect  <container id> ` // 查看容器IP
`docker network inspect mynetwork(自定义网络)`  // 查看容器IP

## 进入容器
###  attach

`exit` 会导致容器停止
`docker attach  <container id> `

### exec
`exit`  不会导致容器停止
`docker  exec  -i -t  <container id>  bash`  // 推荐使用