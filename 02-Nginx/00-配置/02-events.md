```
events {
  use epoll;
  worker_connections 51200; // 一个子进程最发允许连接数
  multi_accept on;
}
```

