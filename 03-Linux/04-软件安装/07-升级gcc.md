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

