```shell
#  模板（box）相关命令
vagrant box list  # 列出虚机模板
vagrant box add USERNAME/BOX_NAME  # 添加别人做好的虚机，在线下载。
vagrant box add PATH/TO/BOX  # 添加本地离线下载好的box
vagrant box remove  # 移除虚机

# 虚机（vm）相关命令
vagrant init  BOX  # 初始化一个Vagrantfile文件。BOX为虚机模板名
vagrant status  [VM_NAME]  # 虚拟机状态。不跟参数默认查看所有虚机，指定虚机名字（VM_NAME）查看指定的虚机状态
vagrant destroy [VM_NAME]  # 删除虚机。不跟参数默认删除所有，指定虚机名字（VM_NAME）删除指定的虚机
vagrant up [VM_NAME]  # 启动虚机。不跟参数默认启动所有，指定虚机名字（VM_NAME）启动指定的虚机
vagrant down [VM_NAME]  # 关闭虚机。不跟参数默认关闭所有，指定虚机名字（VM_NAME）关闭指定的虚机
vagrant suspend [VM_NAME]  # 挂起虚机。不跟参数默认关闭所有，指定虚机名字（VM_NAME）挂起指定的虚机
vagrant resume [VM_NAME]  # 从挂起状态恢复运行。不跟参数默认恢复所有，指定虚机名字（VM_NAME）恢复指定的虚机
vagrant reload [VM_NAME]  # 从挂起状态恢复运行。不跟参数默认恢复所有，指定虚机名字（VM_NAME）恢复指定的虚机
```

https://www.jianshu.com/p/d56d42b8d97f



安装

插件

```
vagrant plugin install vagrant-vbguest
```







## 增加虚拟机

centos6

```
https://cloud.centos.org/centos/6/vagrant/x86_64/images/CentOS-6-x86_64-Vagrant-1905_01.VirtualBox.box
```

centos7

```
https://cloud.centos.org/centos/7/vagrant/x86_64/images/CentOS-7-x86_64-Vagrant-1907_01.VirtualBox.box
```



```
vagrant box add centos6 [box文件位置]
mkdir centos6
cd centos6
vagrant init centos6
vagrant up // 启动
vagrant ssh // 登录


vagrant box remove [box名称]
vagrant halt  # 关闭虚拟机
vagrant reload  # 重启虚拟机
vagrant status  # 查看虚拟机运行状态
vagrant destroy  # 销毁当前虚拟机

vagrant package --output name.box # 打包 可以将一个虚拟机打包成Box，供别人使用。别人只要用打包的box来创建一个虚拟机即可, 如下:
vagrant box add myubuntu ~/Documents/Vagrant/Ubunutu/ubunut.box


```

## 设置root密码, root身份登录

```
sudo passwd root
su root
```

编辑`vim /etc/ssh/sshd_config`, 修改

```
PermitRootLogin yes
PasswordAuthentication yes

service sshd restart
```



修改Vagrantfile文件

```
config.ssh.username = "root"
config.ssh.password = "root"
config.ssh.insert_key = "true"
```

退出登录, 重新登录

## 配置网络

```
config.vm.network "forwarded_port", guest: 80, host: 8080
```

访问`127.0.0.1:8989`OK，展示出欢迎service欢迎页面。

## 同步文件夹

Mac可以使用`NFS`, mac自带

```
config.vm.network "private_network", ip: "192.168.33.10"
config.vm.synced_folder "宿主机目录", "/vagrant_data", type: "nfs"
```

Windows可以使用`SMB`方式





