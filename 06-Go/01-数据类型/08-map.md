`map`是`key-value`数据结构

## 定义

`map变量名 := make(map[keyType]valueType,  len)`

```go
// 1. 使用make
map1 := make(map[int]string, 10)
map1[0] = "吴勇"
map1[2] = "松江"

fmt.Println(map1) // map[0:吴勇 2:松江]


// 2, 直接赋值
map1 := map[int]string{
  0: "吴勇",
  2: "松江",
}
fmt.Println(map1)
```

1. `map`在使用前一定要`make`
2. ``map`的`key`若重复了, 则以最后这个值为准
3. `map`的`key`是无序的



## 返回值

有2种选择.

赋值给一个变量:  代表`value`

赋值给两个变量:

1. 第一个值表示`value`
2. 第二个值,表示查找的`key`是否存在于`map`里 (Bool类型 )

```go
map1 := make(map[int]string, 10)
map1[0] = "吴勇"
map1[2] = "松江"
test1, exists := map1[0]
if exists {
  fmt.Println(test1)
}
test2 := map1[2]
fmt.Println(test2)
```



## 增加和删除

`map["key"] = value`, `key`没有就增加, 存在就是修改.

`delete(map, "key")`,—删除某个`key`

若要删除map的所有key, 

1. 遍历map, 逐个删除
2. `map = make(map[int]string)`, make一个新的, 让原来的成为垃圾, 被gc回收



## 查找

```go
map1 := map[int]string{
  0: "吴勇",
  2: "松江",
}

if val, ok := map1[0];ok {
  println(1)
  println(val)
} else {
  println(2)
}

// 若在map中存咋, ok返回true, 否则返回 false

```

## 遍历

```go
map1 := map[int]string{
  0: "吴勇",
  2: "松江",
}

for key, value := range map1 {
  fmt.Println(key, value)
}
```

## map切片

动态增加map

```go

map1 := make([]map[string]string, 2) // 超过2个 使用append

map1[0] = make(map[string]string, 1)
map1[0]["name"] = "hello"
map1[0]["age"] = "100"

map1[1] = make(map[string]string,1)
map1[1]["name"] = "hello-1"
map1[1]["age"] = "100-1"

tempMap := map[string]string{
  "name": "hello-2",
  "age": "100-2",
}
map1 = append(map1, tempMap)
fmt.Println(map1)
```

## map排序

1. 没有专门的方法针对map的key排序

2. map默认是无序的, 也不是按照添加顺序存放的, 每次遍历, 输出的顺序可能不一样

![](https://ws2.sinaimg.cn/large/006tNc79ly1g20yi5ypqcj30rm10k76u.jpg)

## 注意事项

1. `map` 是引用类型
2. `map`的容量达到后, 再向`map`增加元素, 会自动扩容, 并不会发生`panic`, 也就是说`map`能动态的增长键值对

























