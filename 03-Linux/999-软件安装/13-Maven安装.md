

```shell
wget http://ftp.cuhk.edu.hk/pub/packages/apache.org/maven/maven-3/3.6.3/binaries/apache-maven-3.6.3-bin.tar.gz

tar xzf apache-maven-3.6.3-bin.tar.gz
mv -f  apache-maven-3.6.3 /usr/local/

vim /etc/profile
# 在文件末尾添加如下代码：
export MAVEN_HOME=/usr/local/apache-maven-3.6.3
export PATH=${PATH}:${MAVEN_HOME}/bin

# 生效
source /etc/profile

# 测试
mvn -v



```

## Maven 阿里云(Aliyun)仓库

修改 maven 根目录下的 conf 文件夹中的 setting.xml 文件，在 mirrors 节点上，添加内容如下

```
<mirrors>


    <mirror>
      <id>alimaven</id>
      <name>aliyun maven</name>
      <url>http://maven.aliyun.com/nexus/content/groups/public/</url>
      <mirrorOf>central</mirrorOf>        
    </mirror>
    
    
</mirrors>
```

