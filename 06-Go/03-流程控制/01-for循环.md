## for循环的三种方式

### 方式1

```go
for i := 0; i<10; i++ {
		fmt.Println(i)
	}
```

### 方式二

```go
j := 1
for j< 10 {
  fmt.Println(j)
  j++
}
```

### 方式三

```go
k := 1
for {
  if K < 10 {
    fmt.Println(k)
  }else {
    break
  }
  k++
}
```

## for-range

遍历字符串按照`字符`来遍历, 而不是按照`字节`

```go
str := "hello"
for index, value := range str {
  fmt.Println(index, value)
}
// 输出
0 104
1 101
2 108
3 108
4 111
```

`range`会复制目标对象, 受直接影响的是数组

```go
data := [3]int{10, 20, 30}
	for key, value := range data {
		if key == 0 {
			data[0] += 100
			data[1] += 200
			data[2] += 300
		}
		fmt.Println(value) // 10 20 30
	}

	fmt.Println(data) // 110 220 330

	for key, value := range data[:] { // 转成切片
		if key == 0 {
			data[0] += 100
			data[1] += 200
			data[2] += 300
		}
		fmt.Println(value) // 210  420 630
	}

	fmt.Println(data) // 210  420 630
```

如果`range`目标表达式是函数调用,  也仅被执行一次

```go
func data() []int  {
	fmt.Println("data int")
	return []int{10, 20, 30}
}

func main {
  for key, value := range data() {
		fmt.Println(key, value)
	}
}

输出:
data int
0 10
1 20
2 30


```





