## docker exec [推荐]

### `-i -t` 参数

`docker exec` 后边可以跟多个参数，这里主要说明 `-i` `-t` 参数。

只用 `-i` 参数时，由于没有分配伪终端，界面没有我们熟悉的 Linux 命令提示符，但命令执行结果仍然可以返回。

当 `-i` `-t` 参数一起使用时，则可以看到我们熟悉的 Linux 命令提示符。

```bash
docker exec -it [CONTAINER ID] bash
```

如果从这个 stdin 中 exit，不会导致容器的停止。这就是为什么推荐大家使用 `docker exec` 的原因。

## nsenter

需要安装

nsenter可以访问另一个进程的名称空间。所以为了连接到某个容器我们还需要获取该容器的第一个进程的PID。可以使用docker inspect命令来拿到该PID。

```shell
# 获取 CONTAINER ID
docker ps
# 查看 docker 信息, 拿到 PID 信息
docker inspect  [CONTAINER ID]

# 访问docker容器
nsenter --target [PID] --mount --uts --ipc --net --pid
```



## `attach` 命令

```shell
docker attach [CONTAINER ID]
```

***注意：* 如果从这个 stdin 中 exit，会导致容器的停止。**