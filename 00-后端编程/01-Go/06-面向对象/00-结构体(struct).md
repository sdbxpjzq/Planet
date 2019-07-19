Go没有class, Go的`struct`和其他编程语言的class有同等的地位, Go是基于struct来实现OOP.

**结构体是值类型**

```go
type Cat struct {
  Name string // 首字母大写,是 public
  Age int
  Ptr *int  // 默认值 nil
  Slice []int // 默认值 nil
  Map1 map[string]string // 默认值 nil
}

func main() {
  var cat Cat // 只创建结构体变量, 没有赋值
  //cat := Cat{
  //	Name: "小白",
  //	Age: 10,
  //}
  fmt.Println(cat)
}

```

## 结构体变量的创建和访问

```go
type Person struct {
  Name string
}

func main() {
  p1 := Person{}
  p2 := new (Person) // 返回指针
  p3 := &Person{}// 返回指针
}
// p2和p3返回的是结构体指针, 但是也支持 p2.name 和p3.name
// 这是因为go底层做了转换((*p2).name 和 (*p3).name)
```

## 值类型

![](https://ws3.sinaimg.cn/large/006tNc79ly1g210pstl1zj313y0hwtbv.jpg)

## 注意事项

1. 结构体的所有字段在内存中是 连续的
2. 结构体是单独定义的类型, 和其他类型进行转换时需要有完全相同的字段名(名字, 个数, 类型)

```go
type A struct {
	Num int
}
type B struct {
	Num int
}


func main() {
	var a A
	var b B
	a = A(b) // 可以转还, 是有要求的
	fmt.Println(a,b)
}
```

3. 结构体进行 `type`重新定义(相当于取别名), Go认为是新的数据类型, 但是相互之间可以强转.

```go
type Student struct {
	Name string
}

type Stu Student

func main() {
	var stu1 Student
	var stu2 Stu
	//stu2 = stu1  错误, 需要转换
	stu2 = Stu(stu1) // 可以强转
	fmt.Println(stu2, stu1)
}
```

4. struct的每个字段, 可以写上一个`tag`, 该`tag`可以通过反射机制来获取, 

   常见的场景 序列化和反序列化

```go

type Student struct {
	Name string `json:"name"`
	Age  int `json:"age"`
}

func main() {
	stu := Student{
		Name: "hello",
		Age:  100,
	}
	jsonStr ,_ := json.Marshal(stu)
	fmt.Println(string(jsonStr)) // {"name":"hello","age":100}

}
```

## 方法

方法是作用在指定的数据类型上的(和指定的数据类型绑定), 因此自定义类型都可以有方法, 而不仅仅是`sruct`

```go
type Student struct {
	Name string `json:"name"`
	Age  int `json:"age"`
}

func (stu Student) test1()  { //  (stu Student)和类型绑定
	fmt.Println("hello student1")
}

// 也可以使用指针传递结构体, 效率高
func (stu *Student) test2()  { //  (stu *Student)和类型绑定
	fmt.Println("hello student2")
}

func main() {
  stu := Student{
    Name: "小明",
  }
	stu.test1()
  stu.test2() // 等价于 (&stu).test2(), 底层做了优化
}
```



## 工厂模式



```go
package lib

type student struct {
	// student 首字母小写, 其他包无法使用, 需要工厂模式
	name string `json:"name"`
	age  int    `json:"age"`
}


func NewStudent(name string, age int) *student {
	return &student{
		name: name,
		age:  age,
	}
}

```

```go
func main() {
	stu := lib.NewStudent("小明", 10)
	fmt.Println(stu)
}
```





















