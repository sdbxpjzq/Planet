```shell
yum groupinstall 'Development Tools'
```

### Python源代码编译安装

源码地址: https://www.python.org/ftp/python/

```shell
yum install yum-utils
yum-builddep python
yum install -y openssl-devel bzip2-devel expat-devel gdbm-devel readline-devel sqlite-devel libffi-devel

curl -O https://www.python.org/ftp/python/3.7.4/Python-3.7.4.tgz
tar xf Python-3.7.4.tgz
cd Python-3.7.4
./configure
make
make install

编辑
vim /etc/profile.d/python.sh
写入
alias python='/usr/local/bin/python3.7'
生效
source /etc/profile.d/python.sh

```

pip升级

```
pip3 install --upgrade pip
```



