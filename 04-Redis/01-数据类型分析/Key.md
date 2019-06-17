|           |                                        |                                       |            |                                                 |                |
| --------- | -------------------------------------- | ------------------------------------- | ---------- | ----------------------------------------------- | -------------- |
| 命令      | 用法                                   | 作用                                  | 时间复杂度 | 解释                                            | 其他           |
| DEL       | `DEL key [key ...]`                    | 删除给定的key                         | `O(N)`     | 字符串`O(1)`,其他结构`O(M)`,`M`是集合的元素个数 |                |
| EXISTS    | `EXISTS key`                           | 检查给定`key`是否存在                 | `O(1)`     |                                                 |                |
| EXPIRE    | `EXPIRE key seconds`                   | 为给定`key` 设置生存时间              | `O(1)`     |                                                 | 参数是秒       |
| EXPIREAT  | `EXPIREAT key timestamp`               | 为给定`key` 设置生存时间              | `O(1)`     |                                                 | 参数是秒时间戳 |
| KEYS      | `KEYS pattern`                         | 查找所有符合给定模式`pattern` 的`key` | `O(N)`     | `N`为数据库中 key 的数量                        |                |
| PERSIST   | `PERSIST key`                          | 移除给定`key`的生存时间               | `O(1)`     |                                                 | 持久某个`key`  |
| PEXPIRE   | `PEXPIRE key milliseconds`             | 为给定`key` 设置生存时间              | `O(1)`     |                                                 | 参数是毫秒     |
| PEXPIREAT | `PEXPIREAT key milliseconds-timestamp` | 为给定`key` 设置生存时间              | `O(1)`     | 参数是毫秒时间戳                                |                |
| PTTL      | `PTTL key`                             | 返回某个`key`的生存时间               | `O(1)`     |                                                 | 参数是毫秒     |
| TTL       | `TTL key`                              | 返回某个`key`的生存时间               | `O(1)`     |                                                 | 参数是秒       |
| TYPE      | `TYPE key`                             | 返回某个`key`的所储存的值的类型       | `O(1)`     |                                                 |                |

