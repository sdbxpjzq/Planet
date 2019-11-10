## where

`and`关键字 写在开头, 因为`where`会自动去掉开头的`and`, 保证sql拼接正确

```xml
<select id="findUserByName" parameterType="String" resultMap="User">
  select * FROM test_user
  <where>
    <if test="name != null">
      and name = #{name}
    </if>
    <if test="age != null">
      and age = #{age}
    </if>
  </where>
</select>
```



## set

```xml
<update id="updateByid">
  update sys_user
  <set>
    <if test="userName != null">
      user_name= #{userName},
    </if>
    <if test="userPassword != null">
      user_password= #{userPassword},
    </if>
  </set>
  <!-- 防止拼接sql出错 -->
  id = #{id}
  where id = #{id}
</update>
```

## `<trim>`+`<where>`

`<trim>`属性:

- `prefix`: 前缀. 给整个字符串加一个`前缀`
- `prefixOverrides`: 前缀覆盖,  去掉整个字符串`前面`多余的字符
- `suffix`: 后缀, 给整个字符串加一个`后缀`
- `suffixOverrides`: 后缀覆盖, 去掉整个字符串`后面`多余的字符

> 这里的 AND 和 OR 后面的空格不能省略 ， 
>
> 为了避免匹配到 andes 、 orders 等单词 。 实际的 prefixeOverride s 包含“AND”、“OR”、“ AND\n”、“OR\n”、“ AND\r”、飞R\r”、 “AND\t”、 “OR\t”， 不仅仅是上面提到的 两个带空格的前缀

```xml
<select id="findUserByName" resultMap="User">
  select * FROM test_user WHERE
  <trim prefix="where" suffixOverrides="and |or ">
    <if test="name != null">
      name = #{name} and
    </if>
    <if test="age != null">
      age = #{age}
    </if>
  </trim>
</select>
```

## `<trim>`+`<set>`

```xml
<update id="updateByid">
  update sys_user
  <trim prefix="set" suffixOverrides=",">
    <if test="userName != null">
      user_name= #{userName},
    </if>
    <if test="userPassword != null">
      user_password= #{userPassword},
    </if>
  </trim>
  where id = #{id}
</update>
```









