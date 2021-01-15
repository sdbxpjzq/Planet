

要使用Java SPI，需要遵循如下约定：

- 1、当服务提供者提供了接口的一种具体实现后，在jar包的META-INF/services目录下创建一个以“接口全限定名”为命名的文件，内容为实现类的全限定名；
- 2、接口实现类所在的jar包放在主程序的classpath中；
- 3、主程序通过java.util.ServiceLoder动态装载实现模块，它通过扫描META-INF/services目录下的配置文件找到实现类的全限定名，把类加载到JVM；
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

那么A公司发布 实现jar包时，则要在jar包中META-INF/services/my.xyz.spi.Search文件中写下如下内容：

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

