负责加载`class文件`, `class文件`在文件开头有特定的文件标识, 所以JVM并不是通过检查文件后缀是不是`.class`来判断是否需要加载的，而是通过**文件开头的特定文件标志**

## Class Loader种类

可以说三个，也可以说是四个（第四个为自己定义的加载器，继承 ClassLoader），系统自带的三个分别为：

1. 启动类加载器(BootstrapClassLoader) ，C++所写
2. 扩展类加载器(ExtensionClassLoader) ，Java所写
3. 应用程序类加载器(AppClassLoader)

我们自己new的时候创建的是应用程序类加载器(AppClassLoader)。

![](https://youpaiyun.zongqilive.cn/image/20200318112155.png)

![](https://youpaiyun.zongqilive.cn/image/20200319142836.png)



- 如果是JDK自带的类(Object、String、ArrayList等)，其使用的加载器是Bootstrap加载器；
- 如果自己写的类，使用的是AppClassLoader加载器；
- Extension加载器是负责将把java更新的程序包的类加载进行



```java
public static void main(String[] args) {
  ClassLoader sysClassLoader = ClassLoader.getSystemClassLoader();
  //获取系统类加载器
  System.out.println(sysClassLoader);
  ClassLoader extClassLoader = sysClassLoader.getParent();
  //获取扩展类加载器
  System.out.println(extClassLoader);
  ClassLoader bsClassLoader = extClassLoader.getParent();
  //获取引导类加载器
  System.out.println(bsClassLoader);
}
```







![](https://youpaiyun.zongqilive.cn/image/20200318112314.png)



```java
public class Test {
    //Test:查看类加载器
    public static void main(String[] args) {

        Object object = new Object();
        //查看是那个“ClassLoader”（快递员把Object加载进来的）
        System.out.println(object.getClass().getClassLoader()); // null
        //查看Object的加载器的上一层
        // error Exception in thread "main" java.lang.NullPointerException（已经是祖先了）
        //System.out.println(object.getClass().getClassLoader().getParent());

        System.out.println();

        Test t = new Test();
        System.out.println(t.getClass().getClassLoader().getParent().getParent()); // null
        System.out.println(t.getClass().getClassLoader().getParent()); // sun.misc.Launcher$ExtClassLoader@4554617c
        System.out.println(t.getClass().getClassLoader()); // sun.misc.Launcher$AppClassLoader@18b4aac2
    }
}
```























































