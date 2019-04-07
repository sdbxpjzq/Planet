字符串的两种表示形式:

1. 双引号, 能识别转义字符
2. 反引号, 以字符串的原生形式输出, 包括换行和特殊字符, 可以实现防止攻击, 输出源代码等效果
3. 字符串一旦赋值, 就不能修改了, Go中的字符串是不可变的
4. 多行字符串拼接, `+`处理问题

```go
var a string = "hello\ndddd"
fmt.Println(a)

var b string = `<script>alert(11)</script>`
fmt.Println(b)

a[0] = 'p' // 报错, 不能修改
```

![](https://ws4.sinaimg.cn/large/006tKfTcgy1g17vepgnc5j30zi0iy75t.jpg)

