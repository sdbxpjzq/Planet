```go
a :=2
switch a {
  case 1:
  println(111)
  case 2:
  println(222)

}
```

匹配项后边不需要添加 `break`关键字.

## fallthrough

`switch`穿透, 如果在`case`语句之后添加`fallthrough`, 则会继续执行下一个`csae`

```go
a :=1
	switch a {
	case 1:
		println(111)
		fallthrough
	case 2:
		println(222)
	}

// 输出
111
222

```

## Type Switch

判断某个`interface`变量中实际指向的变量类型

```go
var x interface{}
y := 100
x = y
switch x.(type) {
  case nil:
  fmt.Println("nil")
  case int:
  fmt.Println("int类型")
}
```

## 相邻的空`case`不构成多条件匹配

```go
a := 'a'
switch a {
  case 'a':
	case 'b':
  println("bb")

}
// 输出 空

```









