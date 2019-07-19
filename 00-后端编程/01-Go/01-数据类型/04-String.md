字符串的两种表示形式:

1. 单引号, 表示一个特殊的类型`rune`, 不做任何转义的内容. 指: `码点字面量(Unicode  code  point)`

2. 双引号, 能识别转义字符

3. 反引号, 以字符串的原生形式输出, 包括换行和特殊字符, 可以实现防止攻击, 输出源代码等效果

4. 字符串一旦赋值, 就不能修改了, Go中的字符串是不可变的, 不能通过`a[0] = 'p'`来修改字符串.

   若要修改,要先`string—> []byte`(0-255, 中文处理不了) 或者`string —> []rune`(中英文都能处理), —> 修改 —> 重新写成`string`

5. 多行字符串拼接, `+`处理问题

6. `string`底层是一个`byte`数组, 因此`string`可以进行切片处理. 返回的子串仍然是`string`

```go
a := "hello\ndddd"
fmt.Println(a) // \n 被转义输出
fmt.Printf("%T", a) //string

b := `<script>alert(11)</script>`
fmt.Println(b) // 原样输出 <script>alert(11)</script>
fmt.Printf("%T", b) //string

a[0] = 'p' // 报错, 不能修改

r := '我'
fmt.Println(r) // 25105
fmt.Printf("%T", r) // int32 --> 别名 []rune
```

![](https://ws4.sinaimg.cn/large/006tKfTcgy1g17vepgnc5j30zi0iy75t.jpg)

## 官方别名

```
byte  alias for uint8
run   alisa for int32
```



## 修改字符串

### 转`[]byte`

```go
str := "helloworld"
arr1 := []byte(str)
arr1[0] = 'y'
str = string(arr1)
fmt.Println(str)
```

### 转`[]rune`

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

## rune, byte, string转换

```go
r := '我'
s := string(r) // rune 转 string
b := byte(r)  // run 转byte
s2 := string(b) // byte 转 string
r2 := rune(b) // byte 转 rune


```















