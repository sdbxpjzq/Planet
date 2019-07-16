| 命令        | 用法                               | 作用                                                         | 时间复杂度 | 解释                                   | 其他     |
| ----------- | ---------------------------------- | ------------------------------------------------------------ | ---------- | -------------------------------------- | -------- |
| APPEND      | `APPEND key value`                 | 在`key`末尾追加`value`                                       | `O(1)`     | 如果`key`不存在，就类似`set key value` |          |
| BITCOUNT    | `BITCOUNT key [start] [end]`       | 计算给定字符串中，被设置为 1 的比特位的数量                  | `O(N)`     | `N`字符串长度                          |          |
| DECR        | `DECR key`                         | `key`存储的值减 `1`                                          | `O(1)`     |                                        |          |
| DECRBY      | `DECRBY key decrement`             | `key`存储的值减`decrement`                                   | `O(1)`     |                                        |          |
| GET         | `GET key`                          | 获取`key` 的值                                               | `O(1)`     |                                        |          |
| GETRANGE    | `GETRANGE key start end`           | 获取`key` 的子字符串                                         | `O(1)`     |                                        |          |
| GETSET      | `GETSET key value`                 | 将给定`key` 的值设为`value`,并返回 key 的旧值                | `O(1)`     |                                        |          |
| INCR        | `INCR key`                         | `key`存储的值加 `1`                                          | `O(1)`     |                                        |          |
| INCRBY      | `INCRBY key increment`             | `key`存储的值加 `increment`                                  | `O(1)`     |                                        |          |
| INCRBYFLOAT | `INCRBYFLOAT key increment`        | `key`存储的值加浮点数`increment`                             | `O(1)`     |                                        |          |
| MGET        | `MGET key [key ...]`               | 返回多个`key` 的值                                           | `O(N)`     | `N`为要查的`key`的数量                 |          |
| MSET        | `MSET key value [key value ...]`   | 同时设置一个或多个`key-value`对                              | `O(N)`     | `N`为要`set`的`key`的数量              |          |
| MSETNX      | `MSETNX key value [key value ...]` | 同时设置一个或多个`key-value`对，当且仅当所有给定`key` 都不存在 | `O(N)`     | `N` 为要设置的`key`的数量              |          |
| SET         | `SET key value [EX seconds]`       | 将字符串值`value`关联到`key`                                 | `O(1)`     |                                        |          |
| SETEX       | `SETEX key seconds value`          | 将值`value`关联到`key`,并将`key` 的生存时间设为`seconds`     | `O(1)`     |                                        | 单位是秒 |
| PSETEX      | `PSETEX key milliseconds value`    | 将值`value`关联到`key`,并将`key` 的生存时间设为`milliseconds` | `O(1)`     |                                        |          |
| SETRANGE    | `SETRANGE key offset value`        | 用`value`参数覆写给定`key`所储存的字符串值                   | `O(1)`     |                                        |          |
| STRLEN      | `STRLEN key`                       | 返回`key`所储存的字符串值的长度                              | `O(1)`     |                                        |          |

### Hash

| 命令         | 用法                                      | 作用                                                         | 时间复杂度 | 解释                       | 其他 |
| ------------ | ----------------------------------------- | ------------------------------------------------------------ | ---------- | -------------------------- | ---- |
| HDEL         | `HDEL key field [field ...]`              | 删除哈希表`key` 中的一个或多个指定域                         | `O(N)`     | `N`为要删除的域的数量      |      |
| HEXISTS      | `HEXISTS key field`                       | 查看哈希表`key`中，给定域`field`是否存在                     | `O(1)`     |                            |      |
| HGET         | `HGET key field`                          | 返回哈希表`key`中给定域`field`的值                           | `O(1)`     |                            |      |
| HGETALL      | `HGETALL key`                             | 返回哈希表`key`中，所有的域和值                              | `O(N)`     | `N`为哈希表的大小          |      |
| HINCRBY      | `HINCRBY key field increment`             | 为哈希表`key`中的域`field`的值加上增量`increment`            | `O(1)`     |                            |      |
| HINCRBYFLOAT | `HINCRBYFLOAT key field increment`        | 为哈希表`key`中的域`field`加上浮点数增量`increment`          | `O(1)`     |                            |      |
| HKEYS        | `HKEYS key`                               | 返回哈希表`key`中的所有域                                    | `O(N)`     | `N`为哈希表的大小          |      |
| HLEN         | `HLEN key`                                | 返回哈希表`key`中域的数量                                    | `O(1)`     |                            |      |
| HMGET        | `HMGET key field [field ...]`             | 返回哈希表`key`中一个或多个给定域的值                        | `O(N)`     | `N`为给定域的数量          |      |
| HMSET        | `HMSET key field value [field value ...]` | 同时将多个`field-value`对设置到哈希表`key`中                 | `O(N)`     | `N`为`field-value`对的数量 |      |
| HSET         | `HSET key field value`                    | 将哈希表`key`中的域`field`的值设为`value`                    | `O(1)`     |                            |      |
| HSETNX       | `HSETNX key field value`                  | 将哈希表`key`中的域`field`的值设置为`value`，当且仅当域`field`不存在 | `O(1)`     |                            |      |
| HVALS        | `HVALS key`                               | 返回哈希表`key`中所有域的值                                  | `O(N)`     | `N`为哈希表的大小          |      |
| HSTRLEN      | `HSTRLEN key field`                       | 返回哈希表`key`中与给定域`field`相关联的值的字符串长度       | `O(1)`     |                            |      |