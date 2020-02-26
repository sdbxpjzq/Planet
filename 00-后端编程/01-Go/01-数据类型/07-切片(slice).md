

- 切片是数组的一个引用, 因此切片是引用类型

- 切片的使用和数组类似, 遍历切片, 访问切片的元素和长度(`len(slice)`)都一样

- 切片的长度是可以变化的, 切片是一个可以动态变化的数组



## 定义

```go
var 变量名 []类型
var a []int
```

### 方式1

定义一个切片, 让切片去引用一个已经创建好的数组

```go
intArr1 := [5]int{1, 2, 3, 4, 5}

// 使用 intArr1 生成一个切片
// intArr1[1:3] 从下标1开始, 到下标3结束(不包括下标3)
slice := intArr1[1:3]
fmt.Println(intArr1) // [1 2 3 4 5]
fmt.Println(slice) // [2 3]
fmt.Println(len(intArr1)) // 5
fmt.Println(len(slice))// 2
fmt.Println(cap(slice))// 4 切片的容量是可以动态变化的, 一般要比 len 大

```

### 方式2

使用`make`创建切片

```go
切片名 := make([]type, len, [cap]) // cap 可选项
```

```go
slice := make([]int, 5)
slice[0] = 1
slice[1] = 2
fmt.Println(slice)

```

### 方式3

定义一个切片, 直接就指定具体的数组

```go
slice := []int{1,2,3,4}
fmt.Println(slice)
fmt.Println(cap(slice))
```

1. 通过`make`方式创建切片可以指定切片的大小和容量. `make`也会创建一个数组, 是由切片进行维护的

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1g20uo0fbr9j30eo05m0sp.jpg)



1. 如果没有给切片赋值, 将使用默认值



## 内存分析

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1g20u6g3douj30fi08baa7.jpg)



`slice`是一个引用类型

`slice`从底层来说, 其实就是一个数据结构(`struct`结构体)

```go
type slice struct {
  ptr *[2]int
  len int
  cap int
}
```

## 切片的遍历

`for` 和 `for-range`



## 注意事项

1. 切片初始化,`slice := arr[startIndex: endIndex]`,从arr数组下标`startIndex`, 取到下标`endIndex`的元素(不含`arr[endIndex]`)
   1. `slice := arr[0:end]`,—> `slice := arr[:end]`
   2. `slice := arr[start:end]` —> `slice := arr[start:]`
   3. `slice := arr[0:len(arr)]` —> `slice := arr[:]`
2. `cap`是一个内置函数, 用于统计切片的容量, 最大可以存放多少和元素

## append

对切片进行动态追加.

使用`...`运算符, 可以将一个切片的所有元素追加到另一个切片里.

```go
slice := []int{1, 2, 3, 4}
slice = append(slice, 100, 200, 300)// 返回一个全新的变量, 不改变原有值

a := []int{400, 500}

slice = append(slice, a...) // 注意
fmt.Println(slice)
```

切片`append`操作的本质就是对数组扩容



## copy



```go
slice := []int{1, 2, 3, 4}
slice = append(slice, 100, 200, 300)

a := []int{400, 500}

copy(slice, a)
fmt.Println(slice) // [400 500 3 4 100 200 300]
fmt.Println(a) // [400 500]


```

```go
slice := make([]int, 1) // 1个长度
a := []int{400, 500} // 2个长度

copy(slice, a)
fmt.Println(slice) // [400] , len 小, 不会报错
fmt.Println(a) // [400 500]
```

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1g20wp1pcloj31le0oqaez.jpg)



## 多维切片

```go
// 创建一个整型切片的切片
slice := [][]int{{10}, {100, 200}}
// 为第一个切片追加值为 20 的元素 
slice[0] = append(slice[0], 20)
```

## 函数间传递切片

由于与切片关联的数据包含在底层数组里，不属于切片本身，所以将切片
复制到任意函数的时候，对底层数组大小都不会有影响。复制时只会复制切片本身，不会涉及底层数组



![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1g2jqcxs1cdj31640qw76h.jpg)



























