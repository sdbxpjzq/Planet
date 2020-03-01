```xml
LIMIT ${(pageNo-1)*pageSize},${pageSize}; （正确）

或者
LIMIT #{offSet},#{limit}; （推荐，代码层可控）

```

