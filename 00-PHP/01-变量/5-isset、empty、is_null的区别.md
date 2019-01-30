## isset

判断变量是否定义或者是否为空

变量存在返回`ture`，否则返回`false`
变量定义不赋值返回`false`
`unset`一个变量，返回`false`
变量赋值为`null`，返回`false`

## empty
判断变量的值是否为空，能转换为`false`的都是空，为空返回`true`，反之返回`false`。

`"",0,"0",NULL，FALSE`都认为为空，返回`true`
没有任何属性的对象都认为是空

## is_null
检测传入的值(值、变量、表达式)是否为`null`

定义了，但是赋值为`Null`
定义了，但是没有赋值 
`unset`一个变量

