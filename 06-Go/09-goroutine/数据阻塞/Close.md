```go
// 消费者
func consumer(data chan int, done chan bool) {
	for value := range data { // 接收数据, 直到通道关闭
		fmt.Println(value)

	}
	done <- true
	close(done)
}

// 生产者
func producer(data chan int) {
	for i := 0; i < 4; i++ {
		data <- i
	}
	close(data) // 数据生产结束, 关闭通道
}

func main() {
	done := make(chan bool)
	data := make(chan int)
	go consumer(data, done)
	go producer(data)
	<-done  // 阻塞. 直到消费者关闭

	fmt.Println("main  结束")

}


```

