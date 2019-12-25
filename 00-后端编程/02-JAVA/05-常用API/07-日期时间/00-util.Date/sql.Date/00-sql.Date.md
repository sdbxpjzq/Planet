## `util.Date`转换为`sql.Date`



```java
Date utilDate = new java.util.Date(23432432423223L);
java.sql.Date sqlDate = new java.sql.Date(utilDate.getTime());
System.out.println(utilDate); // Fri Jul 19 01:00:23 CST 2712
System.out.println(sqlDate); // 2712-07-19

```









































