每一个源文件都可以包含一个`init`函数, 该函数会在`main`函数执行前被调用

```go
func sum(args ...int) (sum int) {
	len := len(args)
	for i := 0; i < len; i++ {
		sum += args[i]
	}
	return
}

// 通常可以在init函数中完成初始化工作
func init()  {
	fmt.Println("hello")
}

func main() {
	a := sum(1,2,3)
	fmt.Println(a)
}
```

如果`main.go`和`utils.go`都含有变量定义,`init`函数, 执行流程如下:

![](https://ws1.sinaimg.cn/large/006tNc79gy1g1twbkrgzrj30ir05nwem.jpg)