分支选择, (带了break的switch-case), 只会进入其中的一个分支条件

```xml
<!-- 如果带了 name就用name, 如果带了id就用id, 只会进入其中一个 -->
<select id="findUserByName" resultMap="User">
  select * FROM test_user
  <where>
    <choose>
      <when test="id != null">
        id = #{id}
      </when>
      <when test="name != null">
        name = #{name}
      </when>
      
      <otherwise>
        1 = 2
      </otherwise>
    </choose>
  </where>
</select>
```









































