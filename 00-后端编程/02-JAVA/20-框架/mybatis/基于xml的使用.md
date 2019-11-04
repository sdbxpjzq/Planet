## 基本查询

```xml
<!-- 
	namespace：命名空间，它的作用就是对SQL进行分类化管理，可以理解为SQL隔离
	注意：使用mapper代理开发时，namespace有特殊且重要的作用
 -->
<mapper namespace="包名.Test">
	<!-- 
		[id]：statement的id，要求在命名空间内唯一 (方法名) 
		[parameterType]：入参的java类型
		[resultType]：查询出的单条结果集对应的java类型
		[#{}]： 表示一个占位符?
		[#{id}]：表示该占位符待接收参数的名称为id。注意：如果参数为简单类型时，#{}里面的参数名称可以是任意定义
	 -->
	<select id="findUserById" parameterType="int" resultType="com.gyf.domain.User">
		SELECT * FROM USER WHERE id = #{id}
	</select>
</mapper>
```

## 插入操作

```xml
  
  <insert id="insertUser">
        insert into test_user(`name`, `password`) values (#{name}, #{password});
    
    
    <!-- 获取自增ID-->
    
    <!-- 
			[selectKey标签]：通过select查询来生成主键
			[keyProperty]：指定存放生成主键的属性
			[resultType]：生成主键所对应的Java类型
			[order]：指定该查询主键SQL语句的执行顺序，相对于insert语句
			[last_insert_id]：MySQL的函数，要配合insert语句一起使用 -->
    
        <selectKey keyProperty="id" resultType="int" order="AFTER">
            SELECT LAST_INSERT_ID()
        </selectKey>
    </insert>
```

## 模糊查询

```xml
<!-- 
		[${}]：表示拼接SQL字符串
	 	[${value}]：表示要拼接的是简单类型参数。
		 注意：
		1、如果参数为简单类型时，${}里面的参数名称必须为value 
		2、${}会引起SQL注入，一般情况下不推荐使用。但是有些场景必须使用${}，比如order by ${colname}
	-->
	<select id="findUserByName" parameterType="String" resultType="com.gyf.domain.User">
		SELECT * FROM USER WHERE username like '%${value}%'
	</select>

```

## 小结

```
parameterType和resultType
parameterType指定输入参数的java类型，可以填写别名或Java类的全限定名。
resultType指定输出结果的java类型，可以填写别名或Java类的全限定名。

#{}和${}
#{}：相当于预处理中的占位符？。
#{}里面的参数表示接收java输入参数的名称。
#{}可以接受HashMap、POJO类型的参数。
当接受简单类型的参数时，#{}里面可以是value，也可以是其他。
#{}可以防止SQL注入。
${}：相当于拼接SQL串，对传入的值不做任何解释的原样输出。
${}会引起SQL注入，所以要谨慎使用。
${}可以接受HashMap、POJO类型的参数。
当接受简单类型的参数时，${}里面只能是value。

selectOne和selectList
selectOne：只能查询0或1条记录，大于1条记录的话，会报错：
selectList：可以查询0或N条记录

```













