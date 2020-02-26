为了函数执行结束后, 及时释放资源(例如数据库链接, 文件句柄), 提供了`deffer`(延时机制)

```go
func sum(num1 int, num2 int) int {
	defer fmt.Println(num2) // 顺序3
	defer fmt.Println(num1) // 顺序2

	sum := num1 + num2
	fmt.Println(sum)  // 顺序1
	return sum
}

func main() {
	a := sum(1,2)
	fmt.Println("aa",a) // 顺序4
}
```

当执行到`deffer`时,暂时不执行, 会将`deffer`后面的语句压入到独立的栈(`deffer栈`). 入栈时,也会将相关的值`拷贝`同时入栈

当函数执行完毕后, 再从`deffer栈`,按照先进后出的方式, 出栈执行



![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1g1twu3spk8j30ji0ch74x.jpg)