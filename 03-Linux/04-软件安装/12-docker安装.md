# 安装

https://docs.docker.com/install/linux/docker-ce/centos/

```shell
yum  remove docker  docker-common docker-selinux  docker-engine

yum install -y yum-utils  device-mapper-persistent-data lvm2
// 设置yum源
yum-config-manager --add-repo https://download.docker.com/linux/centos/docker-ce.repo
// 列出所有版本
 yum list docker-ce --showduplicates|sort -r  
// 选择一个版本安装
yum  install -y  docker-ce-18.09.9
// 设置开机启动
systemctl start docker
systemctl enable docker
// 配置国内源
vi /etc/docker/daemon.json 
{
    "registry-mirrors": ["http://hub-mirror.c.163.com"]
}

```