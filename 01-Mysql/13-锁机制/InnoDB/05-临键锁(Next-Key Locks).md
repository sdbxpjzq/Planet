临键锁是间隙锁和记录锁的结合，配合使用防止幻读的发生

假设 有表person，字段有id, name。隔离级别为 Repeatable read。

表内容：

| id   | name |
| ---- | ---- |
| 2    | Ray  |
| 7    | Mike |

id 为主键或唯一键：

`update person set name = ‘XX’ where id > 5`

临键锁锁住的区域为：

(5,7]

(7,正无穷]



