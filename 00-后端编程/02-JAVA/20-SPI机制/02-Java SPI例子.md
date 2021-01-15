

- 数据库驱动加载接口实现类的加载
  JDBC加载不同类型数据库的驱动
- 日志门面接口实现类加载
  SLF4J加载不同提供商的日志实现类
- Spring
  Spring中大量使用了SPI,比如：对servlet3.0规范对ServletContainerInitializer的实现、自动类型转换Type Conversion SPI(Converter SPI、Formatter SPI)等
- Dubbo
  Dubbo中也大量使用SPI的方式实现框架的扩展, 不过它对Java提供的原生SPI做了封装，允许用户扩展实现Filter接口







**1.common-logging**  

apache最早提供的日志的门面接口。只有接口，没有实现。具体方案由各提供商实现， 发现日志提供商是通过扫描 META-INF/services/org.apache.commons.logging.LogFactory配置文件，通过读取该文件的内容找到日志提工商实现类。

只要我们的日志实现里包含了这个文件，并在文件里制定 LogFactory工厂接口的实现类即可。关注Java技术栈微信公众号，在后台回复关键字：Java，可以获取更多栈长整理的Java技术干货。





**2.jdbc**  

 jdbc4.0以前， 开发人员还需要基于Class.forName("xxx")的方式来装载驱动，jdbc4也基于spi的机制来发现驱动提供商了，可以通过META-INF/services/java.sql.Driver文件里指定实现类的方式来暴露驱动提供者。



