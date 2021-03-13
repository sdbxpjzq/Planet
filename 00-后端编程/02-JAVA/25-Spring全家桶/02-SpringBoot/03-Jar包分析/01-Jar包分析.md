**META-INF 目录**：通过 MANIFEST.MF 文件提供 jar 包的元数据，声明了 jar 的启动类。

**org 目录**：为 Spring Boot 提供的 spring-boot-loader 项目，它是 java -jar 启动 Spring Boot 项目的秘密所在，也是将深入了解的部分。

**BOOT-INF/lib 目录**：Spring Boot 项目中引入的依赖的 jar 包们。spring-boot-loader 项目很大的一个作用，就是解决 jar 包里嵌套 jar 的情况，如何加载到其中的类。

**BOOT-INF/classes 目录**：在 Spring Boot 项目中 Java 类所编译的 .class、配置文件等等



 spring-boot-loader 项目需要解决两个问题：

1. 如何引导执行我们创建的 Spring Boot 应用的启动类，例如上述图中的 Application 类。
2. 如何加载 BOOT-INF/class 目录下的类，以及 BOOT-INF/lib 目录下内嵌的 jar 包中的类。



**2、MANIFEST.MF**

它实际是一个 Properties 配置文件，每一行都是一个配置项目。

```
Manifest-Version: 1.0
Spring-Boot-Classpath-Index: BOOT-INF/classpath.idx
Implementation-Title: spring-boot-test
Implementation-Version: 0.0.1-SNAPSHOT
Spring-Boot-Layers-Index: BOOT-INF/layers.idx
Start-Class: com.aleo.springboottest.SpringBootTestApplication
Spring-Boot-Classes: BOOT-INF/classes/
Spring-Boot-Lib: BOOT-INF/lib/
Build-Jdk-Spec: 1.8
Spring-Boot-Version: 2.4.2
Created-By: Maven Jar Plugin 3.2.0
Main-Class: org.springframework.boot.loader.JarLauncher
```

重点来看看两个配置项：

- `Main-Class 配置项`：Java 规定的 jar 包的启动类，这里设置为 spring-boot-loader 项目的` JarLauncher` 类，进行 Spring Boot 应用的启动。
- `Start-Class 配置项`：Spring Boot 规定的主启动类，这里设置为我们定义的 Application 类。

为什么会有 Main-Class/Start-Class 配置项呢？因为是通过 Spring Boot 提供的 Maven 插件 spring-boot-maven-plugin 进行打包，该插件将该配置项写入到 MANIFEST.MF 中，从而能让 spring-boot-loader 能够引导启动 Spring Boot 应用。

Start-Class 对应的 Application 类自带了 #main(String[] args) 方法，直接运行会如何呢？

```
$ java -classpath spring-boot-test-0.0.1-SNAPSHOT.jar com/aleo/springboottest/SpringBootTestApplication
错误: 找不到或无法加载主类 com/aleo/springboottest/SpringBootTestApplication
```

直接找不到 Application 类，因为它在 BOOT-INF/classes 目录下，不符合 Java 默认的 jar 包的加载规则。因此，需要通过 JarLauncher 启动加载。

当然实际还有一个更重要的原因，Java 规定可执行器的 jar 包禁止嵌套其它 jar 包。但是我们可以看到 BOOT-INF/lib 目录下，实际有 Spring Boot 应用依赖的所有 jar 包。因此，spring-boot-loader 项目自定义实现了 ClassLoader 实现类 LaunchedURLClassLoader，支持加载 BOOT-INF/classes 目录下的 .class 文件，以及 BOOT-INF/lib 目录下的 jar 包。



## **JarLauncher**

JarLauncher 类是针对 Spring Boot jar 包的启动类，整体类图如下所示：

![](https://youpaiyun.zongqilive.cn/image/20210312175735.png)

```java
public class JarLauncher extends ExecutableArchiveLauncher {

   //加载jar包的class
   static final String BOOT_INF_CLASSES = "BOOT-INF/classes/";

   //加载jar包的其他依赖，避免嵌套依赖
   static final String BOOT_INF_LIB = "BOOT-INF/lib/";

   public JarLauncher() {
   }

   protected JarLauncher(Archive archive) {
      super(archive);
   }

   @Override
   protected boolean isNestedArchive(Archive.Entry entry) {
      if (entry.isDirectory()) {
         return entry.getName().equals(BOOT_INF_CLASSES);
      }
      return entry.getName().startsWith(BOOT_INF_LIB);
   }

   public static void main(String[] args) throws Exception {
       //这里是开始真正执行
      new JarLauncher().launch(args);
   }

}
```

**父类的launch方法**

紧接着，执行父类的launch方法

```java
protected void launch(String[] args) throws Exception {
   //3.2.1 注册 SpringBoot 自定义的URLStreamHandler实现类，用于jar包的加载读取
   JarFile.registerUrlProtocolHandler();
   //3.2.2 getClassPathArchives()后创建类加载器
   ClassLoader classLoader = createClassLoader(getClassPathArchives());
   //3.2.3 执行application的执行类
   launch(args, getMainClass(), classLoader);
}
```



## 总结

![](https://youpaiyun.zongqilive.cn/image/20210312180125.png)

红色部分，解决 jar 包中的类加载问题：通过 Archive，实现 jar 包的遍历，将 META-INF/classes 目录和 META-INF/lib 的每一个内嵌的 jar 解析成一个 Archive 对象。

- 通过 Archive，实现 jar 包的遍历，将 META-INF/classes 目录和 META-INF/lib 的每一个内嵌的 jar 解析成一个 Archive 对象。

- 通过 Handler，处理 jar: 协议的 URL 的资源读取，也就是读取了每个 Archive 里的内容。

- 通过 LaunchedURLClassLoader，实现 META-INF/classes 目录下的类和 META-INF/classes 目录下内嵌的 jar 包中的类的加载。具体的 URL 来源，是通过 Archive 提供；具体 URL 的读取，是通过 Handler 提供。

  

橘色部分，解决 Spring Boot 应用的启动问题：

- 通过 MainMethodRunner ，实现 Spring Boot 应用的启动类的执行。
- 通过反射调用主启动类的 #main(String[] args) 方法，启动 Spring Boot 应用。

当然，上述的一切都是通过 Launcher 来完成引导和启动，通过 MANIFEST.MF 进行具体配置。























