ZADD：向指定Sorted Set中添加1个或多个member，时间复杂度O(Mlog(N))，M为添加的member数量，N为Sorted Set中的member数量
ZREM：从指定Sorted Set中删除1个或多个member，时间复杂度O(Mlog(N))，M为删除的member数量，N为Sorted Set中的member数量
ZCOUNT：返回指定Sorted Set中指定score范围内的member数量，时间复杂度：O(log(N))
ZCARD：返回指定Sorted Set中的member数量，时间复杂度O(1)
ZSCORE：返回指定Sorted Set中指定member的score，时间复杂度O(1)
ZRANK/ZREVRANK：返回指定member在Sorted Set中的排名，ZRANK返回按升序排序的排名，ZREVRANK则返回按降序排序的排名。时间复杂度O(log(N))
ZINCRBY：同INCRBY，对指定Sorted Set中的指定member的score进行自增，时间复杂度O(log(N))

