分支选择, (相当于是 `带了break的switch-case`), 只会进入其中的一个分支条件

```xml
<!-- 如果带了 name就用name, 如果带了id就用id, 只会进入其中一个 -->
<select id="findUserByName" resultMap="User">
  select * FROM test_user
  <where>
    <choose>
      <!--条件1 -->
      <when test="id != null">
        id = #{id}
      </when>
      <!--条件2 -->
      <when test="name != null">
        name = #{name}
      </when>
      <!--无匹配 走到这里 -->
      <otherwise>
        1 = 2
      </otherwise>
    </choose>
  </where>
</select>
```









































