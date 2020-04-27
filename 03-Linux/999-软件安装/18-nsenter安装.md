## 使用`nsenter`进入`Docker`容器



```shell
wget https://mirrors.edge.kernel.org/pub/linux/utils/util-linux/v2.34/util-linux-2.34.tar.gz

tar -xzvf util-linux-2.34.tar.gz
cd util-linux-2.34
./configure --without-ncurses
make nsenter
cp nsenter /usr/local/bin

inspect --help
```



进入docker

nsenter可以访问另一个进程的名称空间。所以为了连接到某个容器我们还需要获取该容器的第一个进程的PID。可以使用docker inspect命令来拿到该PID。

```shell
# 获取 CONTAINER ID
docker ps
# 查看 docker 信息, 拿到 PID 信息
docker inspect  [CONTAINER ID]

# 访问docker容器
nsenter --target [PID] --mount --uts --ipc --net --pid
```

