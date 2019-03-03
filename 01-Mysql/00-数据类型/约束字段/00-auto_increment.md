`AUTO_INCREMENT`在`Innodb`和`MyISAM`有不同的表现

## Innodb

再`Innodb`,**仅被存储在主内存中，而不是存在磁盘上**

服务器启动之后会重新获取最大值

### 案例

```sql
create table t1(
    id int auto_increment, 
    a int, primary key (id)
) engine=innodb;
insert into t1 values (1,2);
insert into t1 values (null,2);
insert into t1 values (null,2);
select * from t1;
```

![](https://ws2.sinaimg.cn/large/006tKfTcgy1g0pnle1l7pj31am090glf.jpg)

执行删除操作

```sql
delete from t1 where id=2;
delete from t1 where id=3;
select * from t1;
```

![](https://ws1.sinaimg.cn/large/006tKfTcly1g0pnm2jxpdj31b6050a9u.jpg)



关闭MySQL，再启动MySQL,然后再插入一条数据

![](https://ws3.sinaimg.cn/large/006tKfTcgy1g0pnly0hvhj31bg06oq2q.jpg)

我们看到插入了（2,2），而如果我没有重启，插入同样数据我们得到的应该是（4,2)。 上面的测试反映了**MySQLd重启后，InnoDB存储引擎的表自增id可能出现重复利用的情况**。

### 改进

参数`innodb_autoinc_persistent_interval` 用于控制持久化`AUTO_INCREMENT`值的频率.

例如： 

```
innodb_autoinc_persistent_interval=100，auto_incrememt_increment=1
```

时，即每100次`insert`会控制持久化一次`AUTO_INCREMENT`值。

每次持久的值为：`当前值 + innodb_autoinc_persistent_interval`。



测试说明

```sql
 innodb_autoinc_persistent=ON, innodb_autoinc_persistent_interval=1时性能损耗在%1以下。
 
innodb_autoinc_persistent=ON, innodb_autoinc_persistent_interval=100时性能损耗可以忽略。
```



## MyISAM

myisam会将这个值实时存储在`.MYI`文件中.因此，MyISAM表重启是不会出现自增id重复的问题。











