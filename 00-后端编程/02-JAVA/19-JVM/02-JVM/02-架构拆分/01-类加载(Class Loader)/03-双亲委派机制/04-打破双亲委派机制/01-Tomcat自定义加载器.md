## Tomcat自定义加载器打破双亲委派机制

Tomcat是个web容器，那么它要解决什么问题：

**简而言之：不同第三方类库的不同版本要具备隔离性、相同类库相同版本要共享、容器和应用类库要隔离、支持jsp编译动态加载。**

```
1）一个web容器可能需要部署两个应用程序，不同的应用程序可能会依赖同一个第三方类库的不同版本，不能要求同一个类库在同一个服务器只有一份，因此要保证每个应用程序的类库都是独立的，保证相互隔离。

2）部署在同一个web容器中相同的类库相同的版本可以共享。否则，如果服务器有10个应用程序，那么要有10份相同的类库加载进虚拟机。

3）web容器也有自己依赖的类库，不能与应用程序的类库混淆。基于安全考虑，应该让容器的类库和程序的类库隔离开来。

4）web容器要支持jsp的修改，我们知道，jsp 文件最终也是要编译成class文件才能在虚拟机中运行，但程序运行后修改jsp已经是司空见惯的事情， web容器需要支持 jsp 修改后不用重启。

```

![](https://youpaiyun.zongqilive.cn/image/20210114142428.png)

tomcat 为了实现隔离性，没有遵守双亲委派机制约定，每个 webappClassLoader加载自己的目录下的class文件，不会传递给父类加载器，打破了双 亲委派机制。



从图中的委派关系中可以看出: 

- CommonClassLoader能加载的类都可以被CatalinaClassLoader和SharedClassLoader使用，从而实现了公有类库的共用，而CatalinaClassLoader和SharedClassLoader自己能加 载的类则与对方相互隔离。

- WebAppClassLoader可以使用SharedClassLoader加载到的类，但各个 WebAppClassLoader实例之间相互隔离。

- JasperLoader的加载范围仅仅是这个JSP文件所编译出来的那一个.Class文件，它出现的 目的就是为了被丢弃:当Web容器检测到JSP文件被修改时，会替换掉目前的 JasperLoader的实例，并通过再建立一个新的Jsp类加载器来实现JSP文件的热加载功能。



[打破双亲委派 参考](https://mp.weixin.qq.com/s/eaAeS5u_pR31K2BSZTVOxQ)





























































