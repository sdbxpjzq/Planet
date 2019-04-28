`WaitGroup`的用途：它能够一直等到所有的`goroutine`执行完成，并且阻塞主线程的执行，直到所有的`goroutine`执行完成。

## 三个方法

`sync.WaitGroup`只有3个方法，`Add()`，`Done()`，`Wait()`

其中`Done()`是`Add(-1)`的别名。简单的来说，使用`Add()`添加计数，`Done()`减掉一个计数，计数不为0, 阻塞`Wait()`的运行。

```go
func Countoff(n int) {
  fmt.Println("I am : ", n)
}

func main() {
  wg := sync.WaitGroup{}
  for i := 0; i < 10; i++ {
    wg.Add(1)
    go func(n int) {
      Countoff(n)
      wg.Done()
    }(i)
  }
  go func() {
    wg.Wait()
  }()

}
```

