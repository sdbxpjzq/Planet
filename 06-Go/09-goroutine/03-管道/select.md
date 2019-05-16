使用`select`可以解决从管道取数据阻塞问题

```go
for {
		// 随机选择可用channel接收数据
		select {
		// 注意: 若inidChan一直没有关闭, 不会一直阻塞而产生deadlock, 会自动到下一个case匹配
		case v, ok := <-intChan :
			println("从intChan读取数据")
		case v, ok := <-stringChan :
			println("从stringChan读取数据")
		default:
			// 所有通道不可用
			return
		}
		// 接收到的数据
		println(v)
	}

```

