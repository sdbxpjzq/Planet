|              |                                           |                                                              |            |                            |      |
| ------------ | ----------------------------------------- | ------------------------------------------------------------ | ---------- | -------------------------- | ---- |
| 命令         | 用法                                      | 作用                                                         | 时间复杂度 | 解释                       | 其他 |
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