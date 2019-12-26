```shell
yum groupinstall 'Development Tools'
```

### Python源代码编译安装

源码地址: https://www.python.org/ftp/python/

```shell
yum install yum-utils
yum-builddep python
curl -O https://www.python.org/ftp/python/3.6.0/Python-3.6.0.tgz
tar xf Python-3.6.0.tgz
cd Python-3.6.0
./configure
make
make install

编辑
vim /etc/profile.d/python.sh
写入
alias python='/usr/local/bin/python3.6'
生效
source /etc/profile.d/python.sh

```

