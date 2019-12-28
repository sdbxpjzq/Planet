```
yum remove git
rm -rf /usr/local/git

wget https://mirrors.edge.kernel.org/pub/software/scm/git/git-2.23.1.tar.gz
tar xzf git-2.23.1.tar.gz
cd git-2.23.1
./configure prefix=/usr/local/git
make
make install
echo "export PATH=$PATH:/usr/local/git/bin" >> /etc/profile
source /etc/profile

git --version
```

