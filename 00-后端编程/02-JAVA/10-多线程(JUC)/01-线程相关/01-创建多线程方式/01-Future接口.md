![](https://youpaiyun.zongqilive.cn/image/5e085ee976085c32893df470.jpg)



​	

其他线程不执行完成, 一直等待结果返回, 再往下执行, `FutrueTask`可用于闭锁



状态

```
private static final int NEW          = 0;
private static final int COMPLETING   = 1;
private static final int NORMAL       = 2;
private static final int EXCEPTIONAL  = 3;
private static final int CANCELLED    = 4;
private static final int INTERRUPTING = 5;
private static final int INTERRUPTED  = 6;
```

