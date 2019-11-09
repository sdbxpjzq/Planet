## resultType

```xml
<select id="findUserByName" parameterType="String" resultType="com.zongqi.User">
        select * FROM test_user WHERE name = #{name}
    </select>
```



## resultMap

```xml
<resultMap id="userMap" type="tk.mybatis.simple.model.SysUser">
        <id property="id" column="id"/>
        <result property=" userName" column="user_name"/>
        <result property=" userPassword" column="user_password"/>
        <result property=" userEmail" column="user_email"/>
        <result property=" userinfo " column="user_info"/>
        <result property=" headImg" column="head_img" jdbcType="BLOB"/>
        <result property=" createTime" column="create_time" jdbcType="TIMES TAMP"/>
    </resultMap>

    <select id="findUserByName" parameterType="String" resultMap="userMap">
        select * FROM test_user WHERE name = #{name}
    </select>
```

#### @Mapey("name")

告诉mybatis封装这个map的时候使用哪个属性作为map的key

```java
@Mapkey("lastName")
public Map<String, User> getUserById(Long id);
```





































