## gcc升级

镜像网站

http://ftp.tsukuba.wide.ad.jp/software/gcc/releases/

Building GCC requires GMP 4.2+, MPFR 2.4.0+ and MPC 0.8.0+.

这三个依赖分别是：gmp,mpfr和mpc，下载地址分别如下：

　　　　gmp：http://ftp.gnu.org/gnu/gmp/

　　　　mpfr(GNU镜像)：http://ftp.gnu.org/gnu/mpfr/ 或者官网:http://www.mpfr.org/mpfr-current/

　　　　mpc：http://ftp.gnu.org/gnu/mpc/

gmp

```shell
wget http://ftp.gnu.org/gnu/gmp/gmp-5.1.3.tar.gz
tar -xvzf gmp-5.1.3.tar.gz
cd gmp-5.1.3/
mkdir temp
cd temp/
../configure --prefix=/usr/local/gmp-5.1.3
make
make install
```

mpfr

```shell
wget http://ftp.gnu.org/gnu/mpfr/mpfr-4.0.2.tar.gz
tar -xvzf mpfr-4.0.2.tar.gz
cd mpfr-4.0.2/
mkdir temp
cd temp/

../configure --prefix=/usr/local/mpfr-4.0.2 --with-gmp=/usr/local/gmp-5.1.3

make
make install
```

mpc

```shell
wget http://ftp.gnu.org/gnu/mpc/mpc-1.1.0.tar.gz

tar -xvzf mpc-1.1.0.tar.gz
cd mpc-1.1.0/
mkdir temp
cd temp/

../configure --prefix=/usr/local/mpc-1.1.0 --with-gmp=/usr/local/gmp-5.1.3 --with-mpfr=/usr/local/mpfr-4.0.2

make
make install
```



```shell
vim /etc/profile

直接在文件最后添加一行下面的变量：
export LD_LIBRARY_PATH=$LD_LIBRARY_PATH:/usr/local/mpc-1.1.0/lib:/usr/local/gmp-5.1.3/lib:/usr/local/mpfr-4.0.2/lib

source /etc/profile 
```

gcc

```shell
wget http://ftp.tsukuba.wide.ad.jp/software/gcc/releases/gcc-9.2.0/gcc-9.2.0.tar.gz
tar -xvzf gcc-9.2.0.tar.gz
cd gcc-9.2.0
mkdir output
cd output

# --enable-languages=all 说明(all, default, ada, c, c++, d, fortran, go, jit, lto, objc, obj-c++)

../configure --disable-multilib --enable-languages=c,c++ --with-gmp=/usr/local/gmp-5.1.3 --with-mpfr=/usr/local/mpfr-4.0.2 --with-mpc=/usr/local/mpc-1.1.0

make -j4
make install

```



## version `CXXABI_1.3.8' not found的问题

```shell

cp /usr/local/lib64/libstdc++.so.6.0.27 /usr/lib64/
cd /usr/lib64/
rm -rf libstdc++.so.6
ln -s libstdc++.so.6.0.27 libstdc++.so.6

strings /usr/lib/libstdc++.so.6 | grep 'CXXABI'
strings /usr/lib64/libstdc++.so.6|grep CXXABI
```



## Binutils升级

```shell
wget https://ftp.gnu.org/gnu/binutils/binutils-2.33.1.tar.gz
tar -zxf binutils-2.33.1.tar.gz
cd binutils-2.33.1
./configure --prefix=/usr
make
make install

ld -v 
```

## autoconf升级

```shell
wget ftp://ftp.gnu.org/gnu/autoconf/autoconf-2.69.tar.gz
tar xzvf autoconf-2.69.tar.gz
cd autoconf-2.69
./configure 
make && make install

autoconf --version   

```

## make 升级

```shell
wget https://ftp.gnu.org/gnu/make/make-4.2.tar.gz
tar -zxf make-4.2.tar.gz
./configure
make && make install
ln -sf /usr/local/bin/make /usr/bin/make
make -v
```



## gdb升级

```shell
yum install texinfo
wget https://ftp.gnu.org/gnu/gdb/gdb-8.3.tar.gz
tar -zxvf gdb-8.3.tar.gz
./configure
make
make install

cp gdb/gdb /usr/bin/gdb

gdb -v

```



## gettext升级--好像不需要?

```shell
yum remove gettext
wget https://ftp.gnu.org/gnu/gettext/gettext-0.20.tar.gz
tar -zxvf gettext-0.20.tar.gz
cd gettext-0.20
./configure
make
make install

测试
gettext -v
xgettext

建立链接:
sudo ln /usr/local/bin/xgettext /bin/xgettext
sudo ln /usr/local/bin/msguniq /bin/msguniq
sudo ln /usr/local/bin/msgmerge /bin/msgmerge


```





## glibc升级

 * GNU 'make' 4.0 or newer
   * GCC 6.2 or newer
     building the GNU C Library, as newer compilers usually produce
   * GNU 'binutils' 2.25 or later
   * GNU 'texinfo' 4.7 or later
   * GNU 'bison' 2.7 or later
   * GNU 'sed' 3.02 or newer
   * Python 3.4 or later
   
   * GDB 7.8 or later with support for Python 2.7/3.4 or later
   * GNU 'gettext' 0.10.36 or later

解决方法：

删除LD_LIBRARY_PATH变量的内容

[root@localhost build]# echo $LD_LIBRARY_PATH

`:/usr/local/mpc-1.1.0/lib:/usr/local/gmp-5.1.3/lib:/usr/local/mpfr-4.0.2/lib`

[root@localhost build]# LD_LIBRARY_PATH=

```
LD_LIBRARY_PATH=/usr/local/mpc-1.1.0/lib:/usr/local/gmp-5.1.3/lib:/usr/local/mpfr-4.0.2/lib
```


编译安装成功后重新添加 LD_LIBRARY_PATH:

vim /etc/profile
export LD_LIBRARY_PATH =  $LD_LIBRARY_PATH:/opt/glibc-2.14/lib:/opt/glibc-2.17/lib
//wq 保存退出，使之生效

source /etc/profile



```shell
wget http://mirrors.nju.edu.cn/gnu/libc/glibc-2.30.tar.gz
tar -xvf glibc-2.30.tar.gz
cd glibc-2.30
#决定安装成功的关键,对版本要求。
cat INSTALL |grep -E "newer|later"

mkdir build
cd build
echo $LD_LIBRARY_PATH
# :/usr/local/mpc-1.1.0/lib:/usr/local/gmp-5.1.3/lib:/usr/local/mpfr-4.0.2/lib
# LD_LIBRARY_PATH不能以终结符作为开始和最后一个字符，不能有2个终结符连在一起，所以修改下LD_LIBRARY_PATH即可
# export LD_LIBRARY_PATH=/usr/local/mpc-1.1.0/lib:/usr/local/gmp-5.1.3/lib:/usr/local/mpfr-4.0.2/lib

LD_LIBRARY_PATH=/usr/local/mpc-1.1.0/lib:/usr/local/gmp-5.1.3/lib:/usr/local/mpfr-4.0.2/lib

../configure --prefix=/usr




../configure --prefix=/usr --disable-profile --enable-add-ons --with-headers=/usr/include --with-binutils=/usr/bin


../configure  --prefix=$HOME/local

../configure --prefix=/usr --disable-profile --enable-add-ons --with-headers=/usr/include --with-binutils=/usr/bin

make
make install
# 报错Btw. the script doesn't work if you're installing GNU libc not as your不影响使用

ll /lib64/libc.so.6
strings /lib64/libc.so.6 |grep GLIBC_
```

