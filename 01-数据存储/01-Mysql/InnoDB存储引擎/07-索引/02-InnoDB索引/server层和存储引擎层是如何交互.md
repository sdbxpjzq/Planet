`MySQL`分为`server`层和`存储引擎`层

```sql
CREATE TABLE hero (
    id INT,
    name VARCHAR(100),
    country varchar(100),
    PRIMARY KEY (id),
    KEY idx_name (name)
) Engine=InnoDB CHARSET=utf8;


INSERT INTO hero VALUES
    (1, 'l刘备', '蜀'),
    (3, 'z诸葛亮', '蜀'),
    (8, 'c曹操', '魏'),
    (15, 'x荀彧', '魏'),
    (20, 's孙权', '吴');
```

















































