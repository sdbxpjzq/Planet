

```xml
<update id="updateByid">
  update sys_user set
  user_name= #{userName},
  user_password= #{userPassword},
  user_email =#{userEmail} ,
  user_info= #{userinfo} ,
  head_img = #{headimg , jdbcType=BLOB} ,
  create_time =#{createTime , jdbcType=TIMESTAMP}
  where id = #{id}
</update>
```

