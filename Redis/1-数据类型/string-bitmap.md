Bitmap不是一个确切的数据类型，而是基于String类型定义的一系列面向位操作的方法。

## `SETBIT` 和 `GETBIT`

```shell
127.0.0.1:6379> SETBIT key 10 1
(integer) 1
127.0.0.1:6379> GETBIT key 10
(integer) 1
127.0.0.1:6379> GETBIT key 11
(integer) 0

```

## BITOP

执行不同字符串之间的逐位操作。所提供的操作有`AND`，`OR`，`XOR`和`NOT`。

## BITCOUNT 

`BITCOUNT key [start end]`

计数,返回bitmap里值为`1`的位的个数.

```shell

127.0.0.1:6379> BITCOUNT key
(integer) 1
127.0.0.1:6379> SETBIT key 5 1
(integer) 0
127.0.0.1:6379> BITCOUNT key
(integer) 2

```

## BITPOS

` BITPOS key bit [start] [end]`

返回**第一个**`0`或`1`的位置 

```php

127.0.0.1:6379> BITPOS key 1
(integer) 10
127.0.0.1:6379> BITPOS key 0
(integer) 0
127.0.0.1:6379> 

```





