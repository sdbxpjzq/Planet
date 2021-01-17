![](https://youpaiyun.zongqilive.cn/image/20200603192751.png)
![](https://youpaiyun.zongqilive.cn/image/20200603192759.png)
解压->显示包内容-> 
```shell script
/Users/zongqi/Documents/Code/java调试/mat.app/Contents/MacOS/
./MemoryAnalyzer -data dump

```

## 获取dump文件
![](https://youpaiyun.zongqilive.cn/image/20200603192923.png)

![](https://youpaiyun.zongqilive.cn/image/20200603192930.png)

## 测试代码用例
```java
public class Test1 {
    public static void main(String[] args) throws InterruptedException {
        List<Object> numlist = new ArrayList<>();
        Date birth = new Date();
        for (int i = 0; i < 100; i++) {
            numlist.add(String.valueOf(i));
            Thread.sleep(10);
        }
        System.out.println("数据添加完毕,请操作");
        new Scanner(System.in).next();

        numlist = null;
        birth = null;
        System.out.println("已经置空,请操作");

        new Scanner(System.in).next();
        System.out.println("结束");
    }
}
```
![](https://youpaiyun.zongqilive.cn/image/20200603193042.png)
![](https://youpaiyun.zongqilive.cn/image/20200603193051.png)
