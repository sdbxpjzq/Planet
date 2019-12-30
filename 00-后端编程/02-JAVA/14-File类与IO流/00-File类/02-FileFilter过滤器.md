`java.io.FileFilter`是一个接口，是File的过滤器。 该接口的对象可以传递给File类的`listFiles(FileFilter)` 作为参数， 接口中只有一个方法。

`boolean accept(File pathname) ` ：测试pathname是否应该包含在当前File目录中，符合则返回true。





```java
public class DiGuiDemo4 {
  public static void main(String[] args) {
    File dir = new File("D:\\aaa");
    printDir2(dir);
  }

  public static void printDir2(File dir) {
    // 匿名内部类方式,创建过滤器子类对象
    File[] files = dir.listFiles(new FileFilter() {
      @Override
      public boolean accept(File pathname) {
        return pathname.getName().endsWith(".java")||pathname.isDirectory();
      }
    });
    // 循环打印
    for (File file : files) {
      if (file.isFile()) {
        System.out.println("文件名:" + file.getAbsolutePath());
      } else {
        printDir2(file);
      }
    }
  }
}

```

Lambda优化

```java
public static void printDir3(File dir) {
  // lambda的改写
  File[] files = dir.listFiles(f ->{ 
    return f.getName().endsWith(".java") || f.isDirectory(); 
  });

  // 循环打印
  for (File file : files) {
    if (file.isFile()) {
      System.out.println("文件名:" + file.getAbsolutePath());
    } else {
      printDir3(file);
    }
  }
}
```

