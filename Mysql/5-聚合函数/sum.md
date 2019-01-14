![](https://ws1.sinaimg.cn/large/006tNc79ly1fz5042107kj30f908oq33.jpg)

## 多列求和

方式一:

`sum(chines) + english + math)`

当有`null`值存在时, 是不准确的.

```sql
 select 90+null from dual; // null
```

方式二:

`sum(chinese) + sum(english) + sum(math)`

永远正确

![image-20190113154724979](https://ws4.sinaimg.cn/large/006tNc79ly1fz507mxiz1j30l30eh0u7.jpg)