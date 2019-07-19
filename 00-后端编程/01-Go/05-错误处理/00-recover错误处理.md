Go不支持 try…catch…finally.

Go引入的处理方式为: defer, panic, recover

简单描述: Go中可以抛出一个`panic`的异常, 然后在`deffer`中通过`recover`捕获这个异常, 然后正常处理.

```go
func error()  {

	defer func() {
		err := recover() // 内置函数, 可以捕获到异常
		if err != nil {
			// 存在错误
			fmt.Println("ddd", err)
		}
	}()

	num1 := 100
	num2 := 0
	res := num1 / num2
	fmt.Println(res)
}
```




