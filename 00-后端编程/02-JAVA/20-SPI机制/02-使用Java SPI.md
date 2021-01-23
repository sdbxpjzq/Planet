

要使用Java SPI，需要遵循如下约定：

- 1、当服务提供者提供了接口的一种具体实现后，在jar包的META-INF/services目录下创建一个以`接口全限定名`为命名的文件，内容为实现类的全限定名；
- 2、接口实现类所在的jar包放在主程序的classpath中；
- 3、主程序通过`java.util.ServiceLoder`动态装载实现模块，它通过扫描META-INF/services目录下的配置文件找到实现类的全限定名，把类加载到JVM；
- 4、SPI的实现类必须携带一个不带参数的构造方法；





1. 一个内容管理系统有一个搜索模块。是基于接口编程的。

搜索的实现可能是基于文件系统的搜索，也可能是基于数据库的搜索

```java
// 接口定义
package my.xyz.spi; 
import java.util.List; 
public interface Search { 
  public List serch(String keyword); 
}
```

A公司采用文件系统搜索的方式实现了 Search接口，B公司采用了数据库系统的方式实现了Search接口。

- A公司实现的类：com.A.spi.impl.FileSearch 
- B公司实现的类：com.B.spi.impl.DatabaseSearch  

那么A公司发布 实现jar包时，则要在jar包中`META-INF/services/my.xyz.spi.Search`文件中写下如下内容：

```
com.A.spi.impl.FileSearch
```

那么B公司发布 实现jar包时，则要在jar包中META-INF/services/my.xyz.spi.Search文件中写下如下内容：

```
com.B.spi.impl.DatabaseSearch
```



```java
package com.xyz.factory; 
import java.util.Iterator; 
import java.util.ServiceLoader; 
import my.xyz.spi.Search; 
public class SearchFactory { 
  private SearchFactory() { 
  } 
  public static Search newSearch() { 
    Search search = null; 
    ServiceLoader<Search> serviceLoader = ServiceLoader.load(Search.class); 
    Iterator<Search> searchs = serviceLoader.iterator(); 
    if (searchs.hasNext()) { 
      search = searchs.next(); 
    } 
    return search; 
  } 
}
```

![](https://youpaiyun.zongqilive.cn/image/20210122165730.png)





JDK SPI的使用比较简单，做到了基本的加载扩展组件的功能，但有以下几点不足：

- 需要遍历所有的实现并实例化，想要找到某一个实现只能循环遍历，一个一个匹配；
- 配置文件中只是简单的列出了所有的扩展实现，而没有给他们命名，导致在程序中很难去准确的引用它们；
- 扩展之间彼此存在依赖，做不到自动注入和装配，不提供上下文内的IOC和AOP功能；
- 扩展很难和其他的容器框架集成，比如扩展依赖了一个外部spring容器中的bean，原生的JDK SPI并不支持。

