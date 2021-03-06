redis采用的是**定期删除**+**惰性删除**策略

## 定期删除+惰性删除是如何工作

`定期删除`，redis默认每100ms检查是否有过期的key，有过期key则删除。需要说明的是，redis不是每个100ms将所有的key检查一次，而是随机抽取进行检查(如果每隔100ms,全部key进行检查，redis会卡死)。因此，如果只采用定期删除策略，会导致很多key到时间没有删除。

```shell
# 默认抽取5个key
maxmemory-samples 5 
```



`惰性删除`, 也就是说在你获取某个key的时候，redis会检查一下，这个key如果设置了过期时间那么是否过期了，如果过期了此时就会删除。

## 采用定期删除+惰性删除就没其他问题了么

不是的，如果定期删除没删除key。然后你也没即时去请求key，也就是说惰性删除也没生效。这样，redis的内存会越来越高，如果内存空间用满, 那么会采用`LRU算法`，就会自动驱逐老的数据，即采用内存淘汰机制。



## redis 提供 6种数据淘汰策略：

```
 volatile-lru：从已设置过期时间的数据集（server.db[i].expires）中挑选最近最少使用的数据淘汰

volatile-ttl：从已设置过期时间的数据集（server.db[i].expires）中挑选将要过期的数据淘汰

volatile-random：从已设置过期时间的数据集（server.db[i].expires）中任意选择数据淘汰

allkeys-lru：从数据集（server.db[i].dict）中挑选最近最少使用的数据淘汰

allkeys-random：从数据集（server.db[i].dict）中任意选择数据淘汰

no-enviction（驱逐）：禁止驱逐数据

```



## 从库的过期策略

从库不会进行过期扫描，从库对过期的处理是被动的。主库在 key 到期时，会在 AOF 文件里增加一条 `del` 指令，同步到所有的从库，从库通过执行这条 `del` 指令来删除过期的 key。







