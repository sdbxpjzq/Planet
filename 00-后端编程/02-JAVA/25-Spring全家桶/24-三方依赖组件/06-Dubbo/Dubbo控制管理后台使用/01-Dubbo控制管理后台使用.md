## ## 二、Dubbo控制管理后台使用

---

### **Dubbo 控制后台版本说明：**

 2.5.8 duboo-admin

2.6 dubbo-admin

### **Dubbo 控制后台的安装：**

```
#从github 中下载dubbo 项目
git clone https://github.com/apache/incubator-dubbo.git
#更新项目
git fetch
#临时切换至 dubbo-2.5.8 版本
git checkout dubbo-2.5.8
#进入 dubbo-admin 目录
cd dubbo-admin
#mvn 构建admin war 包
mvn clean pakcage -DskipTests
#得到 dubbo-admin-2.5.8.war 即可直接部署至Tomcat
#修改 dubbo.properties 配置文件
dubbo.registry.address=zookeeper://127.0.0.1:2181
```

注：如果实在懒的构建 可直接下载已构建好的：

链接：[https://pan.baidu.com/s/1zJFNPgwNVgZZ-xobAfi5eQ](https://pan.baidu.com/s/1zJFNPgwNVgZZ-xobAfi5eQ) 提取码：gjtv 


**控制后台基本功能介绍 ：**

* 	服务查找：
* 	服务关系查看:
* 	服务权重调配：
* 	服务路由：
* 	服务禁用