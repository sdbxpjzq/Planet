## 下载Maven

1. 打开Maven官网下载页面：[maven.apache.org/download.cg…](https://link.juejin.im/?target=http%3A%2F%2Fmaven.apache.org%2Fdownload.cgi)
   下载:apache-maven-3.5.0-bin.tar.gz
2. 解压下载的安装包到某一目录，比如：/Users/xxx/Documents/maven

## 配置环境变量

打开terminel输入以下命令：
`vim ~/.bash_profile` 打开.bash_profile文件，在次文件中添加设置环境变量的命令
`export M2_HOME=/Users/xxx/Documents/maven/apache-maven-3.5.0`
`export PATH=$PATH:$M2_HOME/bin`
添加之后保存并推出，执行以下命令使配置生效：
`source ~/.bash_profile`



## 查看配置是否生效

1、输入：mvn -v命令





## 设置国内源

https://www.runoob.com/maven/maven-repositories.html



