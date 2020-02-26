## 不同`goroutine`之间如何通讯

1. 全局变量加锁同步
2. channel

## 全局变量加锁

```go
package main

import (
	"fmt"
	"sync"
	"time"
)

var (
	myMap = make(map[int]int, 10)
	// lock 是一个全局变量的互斥锁
	// sync 是包, 同步
	// Mutex 是互斥
	lock sync.Mutex
)

func test(n int) {
	res := 0
	for i := 0; i < n; i++ {
		res += i
	}

	// 加锁
	lock.Lock()
	myMap[n] = res
	// 解锁
	lock.Unlock()
}

func main() {
	for i := 0; i < 20; i++ {
		go test(i) // 开始20个协程
	}

	// todo 这里并不能正确估算出时间(需要用channel解决)
	time.Sleep(time.Second *5)


	lock.Lock()
	for key, value := range myMap {
		fmt.Println(key, value)
	}
	lock.Unlock()
}

```

## channel

本质是一个数据结构--队列

数据先进先出

线程安全, 多`goroutine`访问, 不需要加锁, 就是说`channel`本身是线程安全的

`channel`是有类型的, 一个`sting`的`channel`只能存放`sting`类型数据

![](https://youpaiyun.zongqilive.cn/image/20200226122243.png)

### 管道简单使用

```go
intChan := make(chan int, 10)
// 写入数据
intChan<- 100
// 读取数据
num := <-intChan
fmt.Println(num)
```

`channel`是引用类型

必须初始化才能写入数据, 即`make`后才能使用

管道是有类型的, `intChan`只能写入`int`型数据

写入数据时, 不能超过其容量, 数据放满之后, 就不能再写入了, 若从`channel`中取出,可继续写入



![](https://youpaiyun.zongqilive.cn/image/20200226122224.png)

## channel关闭

关闭之后就不不能在写入了, 但是可以读取的

```go
allChan := make(chan interface{}, 10)
allChan <- Cat{"小花"}
// 关闭管道, 关闭之后就不不能在写入了
close(allChan)
newCat := <-allChan
a := newCat.(Cat)
fmt.Printf("%v",a.Name)
```

## channel遍历

`for-range`遍历

在遍历时, 若channel没有关闭, 则会出现deadlock的错误

若关闭, 则遍历完后, 正常退出



## 其他说明



3. `goroutine`中使用`recover`, 解决协程中出现的`panic`, 导致程序崩溃问题

   我们起了一个协程, 但是这个协程出现了`panic`, 如果我们没有捕获这个`panic`,就会造成整个程序崩溃, 可以使用`recover`进行处理, 这样即使这个协程出现问题, 主线程仍然不受影响, 可以继续执行

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1g2975y7xvgj30j00c7wf1.jpg)















































