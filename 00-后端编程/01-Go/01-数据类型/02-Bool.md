`bool`类型数据只允许取值`true`和`false`

占1字节

默认值是`false`

不可以`0`或`非0`的整数代替`false`和`true`. 这一点和其他语言不同

```go
// 不能赋值1
	//var a bool = 1
	var a bool = true
	fmt.Println(a)
```

