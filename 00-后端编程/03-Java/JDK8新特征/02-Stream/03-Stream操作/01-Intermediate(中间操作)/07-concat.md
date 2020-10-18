## concat():合并两个stream

```java
public
 
static
 
void
 main
(
String
[]
 args
)
 
{

    
// 创建两个stream对象

    
Stream
<
String
>
 language1 
=
 
Stream
.
of
(
"PHP"
,
 
"JAVA"
);

    
Stream
<
String
>
 language2 
=
 
Stream
.
of
(
"GO"
,
 
"PYTHON"
);

    
// 使用中间操作concat，合并两个stream对象

    
Stream
<
String
>
 concat 
=
 
Stream
.
concat
(
language1
,
 language2
);

    
// 使用结束操作collect,转成list

    
List
<
String
>
 collect 
=
 concat
.collect(Collectors.toList());

    
System.out.println(collect);

  // 输出: [PHP, JAVA, GO, PYTHON]
}
```



![](https://pic.superbed.cn/item/5e09ab8176085c3289b06596.jpg)

![](https://pic.superbed.cn/item/5e09ab8f76085c3289b067e2.jpg)











