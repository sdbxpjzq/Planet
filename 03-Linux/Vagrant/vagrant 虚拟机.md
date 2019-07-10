centos6

```
https://cloud.centos.org/centos/6/vagrant/x86_64/images/CentOS-6-x86_64-Vagrant-1905_01.VirtualBox.box
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

vagrant package name # 打包 可以将一个虚拟机打包成Box，供别人使用。别人只要用打包的box来创建一个虚拟机即可, 如下:
vagrant box add myubuntu ~/Documents/Vagrant/Ubunutu/ubunut.box


```

## 设置root密码

```
sudo passwd root
su root
```

编辑vim /etc/ssh/sshd_config, 修改 PermitRootLogin 值为yes

修改Vagrantfile文件

```
config.ssh.username = "root"
config.ssh.password = "root"
config.ssh.insert_key = "true"
```

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

