什么我们在构建应用时什么都没有配置，也能启动WEB服务器？

为什么默认情况下使用的是Tomcat服务器？

如何对内嵌的Tomcat服务器进行优化？

`org.springframework.boot.autoconfigure.web.servlet.ServletWebServerFactoryAutoConfiguration`

有3种类型

![](https://youpaiyun.zongqilive.cn/image/20210103170219.png)

通过@Import就可以看出这里定义了一个顺序，依次是Tomcat->Jetty->Undertow，意思就是当环境中有Tomcat满足的依赖时就会优先使用Tomcat，依次往后推。

而一般情况下，在SpringBoot依赖中默认就已经引入tomcat的依赖，因此这里对于tomcat来说一般情况下会恒成立，那么Tomcat就会一直作为恒成立条件被SpringBoot首选为默认服务器