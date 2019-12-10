## 获取自增主键

`useGeneratedKeys="true"` -- 使用自增主键策略

`keyProperty` --  指定对应的主键, 也就是mybatis获取主键后, 将这个值封装给`javaBean`的哪个属性值

```xml
<insert id="addOne" parameterType="User" useGeneratedKeys="true" keyProperty="id">
        insert into user_table('name') values (#{name})
</insert>
```



