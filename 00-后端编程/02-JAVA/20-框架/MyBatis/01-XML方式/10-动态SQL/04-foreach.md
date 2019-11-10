## `foreach`实现`in`集合

```xml
<select id="findUserByName" resultMap="User">
  select * FROM test_user where id in
  <foreach collection="ids" item="item_id" separator="," open="(" close=")" index="">
    #{item_id}
  </foreach>
</select>
```

`foreach` 包含以下属性:

- `collection` ： 必填， 值为要选代循环的属 性名。 这个属性值的情况有 很多。 
- `item`：变量名， 值为从法代对象中取 出的每一个值。
- ` index` ：索引的属性名, 在集合数组情况下值为当前索引值 ;  当选代循环的对象是 Map 类型时， 这个值为 Map 的 key （键值）。
- `open`：整个循环内容开头的字符串 
- ` close` : 整个循环内容结尾的字符串。
- `separator` ：每次循环的分隔符 。



## `collection`属性设置问题

源码:`DefaultSqlSession`中的方法, 默认情况下的处理.

- 当参数类型是`集合`的时候, 默认会转为`Map`类型, key为`collection`
- 当参数类型是`List`集合, 会继续添加一个key为`list`, 这样`collection = "list"`就能得到这个集合, 并对它进行循环操作
- 当参数类型书`数组`的时候, 也会转成`Map`类型, 默认的key为`array`.

除了默认情况, 推荐使用`@Param`来指定参数的名, 这时`collection`就设置为`@Param`注解指定的名字

```java
private Object wrapCollection(Object object) {
  DefaultSqlSession.StrictMap map;
  if (object instanceof Collection) {
    map = new DefaultSqlSession.StrictMap();
    map.put("collection", object);
    if (object instanceof List) {
      map.put("list", object);
    }

    return map;
  } else if (object != null && object.getClass().isArray()) {
    map = new DefaultSqlSession.StrictMap();
    map.put("array", object);
    return map;
  } else {
    return object;
  }
}
```































