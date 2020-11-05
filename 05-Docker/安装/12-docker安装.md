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
yum  install -y  docker-ce-19.03.9
// 设置开机启动
systemctl start docker
systemctl enable docker
// 配置国内源
# 方式1
sudo mkdir -p /etc/docker
sudo tee /etc/docker/daemon.json <<-'EOF'
{
  "registry-mirrors": ["https://hx8ia1o6.mirror.aliyuncs.com"]
}
EOF
sudo systemctl daemon-reload
sudo systemctl restart docker


#方式2
curl -sSL https://get.daocloud.io/daotools/set_mirror.sh | sh -s http://f1361db2.m.daocloud.io


```