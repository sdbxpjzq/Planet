```
<sql id="Base_Column_List" >
  id, merchant_id, activity_id, activity_name, activity_type, activity_ctime, activity_start_time
</sql>
```

```
<select id="selectByPrimaryKey" resultMap="BaseResultMap" parameterType="java.lang.Long" >
    select
    // 通过 include 这里引用 id
    <include refid="Base_Column_List" />
    from mkt_merchandise_activity_ref
    where id = #{id,jdbcType=BIGINT}
  </select>
```

















































































抽取可重用的sql片段, 方便后面使用

1. sql抽取, 经常将要查询的列名 或 插入用的列名抽取出来方便引用
2. `include`来引用已经抽取的sql
3. `include`还可以自定义`property`, sql标签内部就能使用自定义属性`${prop}`



![](https://pic.superbed.cn/item/5dc779718e0e2e3ee9e69099.jpg)



自定义属性

![](https://pic.superbed.cn/item/5dc77a4f8e0e2e3ee9e6af86.jpg)





























