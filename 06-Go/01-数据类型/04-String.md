字符串的两种表示形式:

1. 双引号, 能识别转义字符

2. 反引号, 以字符串的原生形式输出, 包括换行和特殊字符, 可以实现防止攻击, 输出源代码等效果

3. 字符串一旦赋值, 就不能修改了, Go中的字符串是不可变的, 不能通过`a[0] = 'p'`来修改字符串.

   若要修改,要先`string—> []byte`(0-255, 中文处理不了) 或者`string —> []rune`(中英文都能处理), —> 修改 —> 重新写成`string`

4. 多行字符串拼接, `+`处理问题

5. `string`底层是一个`byte`数组, 因此`string`可以进行切片处理.

```go
var a string = "hello\ndddd"
fmt.Println(a)

var b string = `<script>alert(11)</script>`
fmt.Println(b)

a[0] = 'p' // 报错, 不能修改
```

![](https://ws4.sinaimg.cn/large/006tKfTcgy1g17vepgnc5j30zi0iy75t.jpg)

## 修改字符串

### 转`[]byte`

```go
str := "helloworld"
arr1 := []byte(str)
arr1[0] = 'y'
str = string(arr1)
fmt.Println(str)
```

转`[]rune`

推荐使用

```go
str := "北京helloworld"
arr1 := []rune(str)
arr1[0] = '宗'
str = string(arr1)
fmt.Println(str) // 宗京helloworld

```

## string和切片的内存形式

![](https://ws3.sinaimg.cn/large/006tNc79ly1g20x0ualzcj30uu0iimxv.jpg)



