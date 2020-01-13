日志分两类，一类是 `Docker 引擎日志`；另一类是 `容器日志`。

## Docker 引擎日志 

```shell
journalctl -u docker.service


```

## 容器日志 

`容器的日志` 则可以通过 `docker logs` 命令来访问，而且可以像 `tail -f` 一样，使用 `docker logs -f` 来实时查看。

如果使用 Docker Compose，则可以通过 `docker-compose logs <服务名>` 来查看。

```shell
docker logs [CONTAINER ID] -f
```

