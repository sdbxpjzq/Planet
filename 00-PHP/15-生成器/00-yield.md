## 什么是 "yield"

`yield`关键字只能在函数中使用，代码执行到`yield`语句，函数的执行就会终止并返回`yield`表达式给`Generator`


## "yield" & "return" 的区别
 ### 返回值的不同

​	`yield`返回`Generator`对象

```shell
function getValues() {
    return 'value';
}
var_dump(getValues()); // string(5) "value"

function getValues() {
    yield 'value';
}
var_dump(getValues()); // class Generator#1 (0) {}
```

生成器 类实现了 迭代器 接口， 这意味着你必须遍历 getValue() 方法来取值：

### 内存占用不同
```php
function getValues() {
   $valuesArray = [];
   // 获取初始内存使用量
   echo round(memory_get_usage() / 1024 / 1024, 2) . ' MB' . PHP_EOL;
   for ($i = 1; $i < 800000; $i++) {
      $valuesArray[] = $i;
      // 为了让我们能进行分析，所以我们测量一下内存使用量
      if (($i % 200000) == 0) {
         // 来 MB 为单位获取内存使用量
         echo round(memory_get_usage() / 1024 / 1024, 2) . ' MB'. PHP_EOL;
      }
   }
   return $valuesArray;
}
$myValues = getValues(); // 一旦我们调用函数将会在这里创建数组
foreach ($myValues as $value) {}
```
输出
```
0.34 MB
8.35 MB
16.35 MB
32.35 MB
```
利用`yield`实现

```php
function getValues() {
   // 获取内存使用数据
   echo round(memory_get_usage() / 1024 / 1024, 2) . ' MB' . PHP_EOL;
   for ($i = 1; $i < 800000; $i++) {
      yield $i;
      // 做性能分析，因此可测量内存使用率
      if (($i % 200000) == 0) {
         // 内存使用以 MB 为单位
         echo round(memory_get_usage() / 1024 / 1024, 2) . ' MB'. PHP_EOL;
      }
   }
}
$myValues = getValues(); // 在循环之前都不会有动作
foreach ($myValues as $value) {} // 开始生成数据

```
输出
```
0.34 MB
0.34 MB
0.34 MB
0.34 MB
```
这不意味着你从 `return` 表达式迁移到 `yield`，但如果你在应用中创建会导致服务器上内存出问题的巨大数组，则` yield` 更加适合你的情况。



## 代码分析

```php
function createRange($number){
    for($i=0;$i<$number;$i++){
        yield time();
    }
}

$result = createRange(10); // 这里调用上面我们创建的函数
foreach($result as $value){
    sleep(1);
    echo $value.'<br />';
}


```

1. 首先调用`createRange`函数，传入参数`10`，但是`for`值执行了一次然后停止了，并且告诉`foreach`第一次循环可以用的值。
2. `foreach`开始对`$result`循环，进来首先`sleep(1)`，然后开始使用`for`给的一个值执行输出。
3. `foreach`准备第二次循环，开始第二次循环之前，它向`for`循环又请求了一次。
4. `for`循环于是又执行了一次，将生成的时间戳告诉`foreach`.
5. `foreach`拿到第二个值，并且输出。由于`foreach`中`sleep(1)`，所以，`for`循环延迟了1秒生成当前时间

所以，整个代码执行中，始终只有一个记录值参与循环，内存中也只有一条信息。

无论开始传入的`$number`有多大，由于并不会立即生成所有结果集，所以内存始终是一条循环的值。

## 实际开发应用

### 读取超大文件

```php
function readTxt()
{
    # code...
    $handle = fopen("./test.txt", 'rb');

    while (feof($handle)===false) {
        # code...
        yield fgets($handle);
    }

    fclose($handle);
}

foreach (readTxt() as $key => $value) {
    # code...
    echo $value.'<br />';
}

```





