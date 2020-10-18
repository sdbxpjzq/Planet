## Collectors.toMap

![](https://youpaiyun.zongqilive.cn/image/20200927090104.png)

```java
// 存对象
Map<Long, User> map = users.stream().collect(Collectors.toMap(User::getId, o -> o));

// 存属性
Map<Long, String> map = users.stream().collect(Collectors.toMap(User::getId, User::getName));
```



## 注意事项

### `map 中的 key 值不能重复`, 若出现重复key, 会抛出异常

![](https://youpaiyun.zongqilive.cn/image/20200927090241.png)

解决办法:

取第一个, 或者 覆盖, 或者 全部保留

![](https://youpaiyun.zongqilive.cn/image/20200927090539.png)

![](https://youpaiyun.zongqilive.cn/image/20200927090616.png)

![](https://youpaiyun.zongqilive.cn/image/20200927090656.png)



### 值不能为空, 若为空抛异常

![](https://youpaiyun.zongqilive.cn/image/20200927090748.png)

解决办法：我们可以将null值默认为空字符串

![](https://youpaiyun.zongqilive.cn/image/20200927090834.png)











