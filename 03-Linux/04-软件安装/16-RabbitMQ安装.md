

```shell
# 带管理界面
docker pull rabbitmq:3.8.2-management

# 5672 是服务端口
# 15672 是web页面管理端口
docker run -d -p 8201:5672 -p 8210:15672 --name myRebbitMQ-1 

```



管理界面:

```
name: guest
pass: guest

```

































