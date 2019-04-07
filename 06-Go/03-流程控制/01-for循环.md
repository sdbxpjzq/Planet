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

