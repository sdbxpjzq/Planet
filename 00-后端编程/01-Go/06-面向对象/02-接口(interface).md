`interface`类型可以定义一组方法, 但是这些方法不需要实现, 在使用的时候, 接口内的方法要**全部实现**
`interface`不能包含任何变量.

接口本身不能创建实例

一个自定义类型可以实现多个接口

接口默认是一个指针(引用类型), 默认值是`nil`

空接口`interface{}`没有任何方法, 所有类型都实现了空接口,可以把任何一个变量赋值给空接口

## 多态通过接口实现

```go
// 定义一个接口
type Usb interface {
	start()
	stop()
}
type Computer struct {
}


func (c Computer) work(usb Usb) {
	usb.start()
	usb.stop()
}


// Phone 实现接口
type Phone struct {
}

func (p Phone) start() {
	fmt.Println("开始工作")
}
func (p Phone) stop() {
	fmt.Println("结束工作")
}

func main() {
	phone := Phone{}
	computer := Computer{}
	computer.work(phone)
}
```

## `nil`状态判定

```go
var a interface{} = nil
var b interface{} = (*int)(nil)
fmt.Println(a == nil) // true
fmt.Println(b == nil) // false
fmt.Println(reflect.ValueOf(b).IsNil()) // true


```

## 



