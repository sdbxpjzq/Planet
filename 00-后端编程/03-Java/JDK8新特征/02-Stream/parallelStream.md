parallelStream 是流并行处理程序的代替方法。

```java
List<String> strings = Arrays.asList("a", "", "c", "", "e","", " ");
// 获取空字符串的数量
long count =  strings.parallelStream().filter(string -> string.isEmpty()).count();
System.out.println("空字符串的个数:"+count);
```





## 方式1_ `stream()`和`parallelStream()`

所有的`Collection`集合都可以通过`stream()`和`parallelStream()`方法获取流

除非显示地创建并行流，否则Java库中创建的都是串行流。

```java
List<Integer> numbers = Arrays.asList(1, 2, 3, 4, 5, 6, 7, 8, 9);
// 并行化 处理, 得到的时乱序
numbers.parallelStream().forEach(integer -> System.out.println(integer));

System.out.println("==================================");

// 串行化处理, 有序
numbers.stream().forEach(integer -> System.out.println(integer));
```

### `stream or parallelStream`

```
1. 是否需要并行？  
2. 任务之间是否是独立的？是否会引起任何竞态条件？  
3. 结果是否取决于任务的调用顺序？ 
```



对于问题1，在回答这个问题之前，你需要弄清楚你要解决的问题是什么，数据量有多大，计算的特点是什么？并不是所有的问题都适合使用并发程序来求解，比如当数据量不大时，顺序执行往往比并行执行更快。毕竟，准备线程池和其它相关资源也是需要时间的。但是，当任务涉及到I/O操作并且任务之间不互相依赖时，那么并行化就是一个不错的选择。通常而言，将这类程序并行化之后，执行速度会提升好几个等级。

对于问题2，如果任务之间是独立的，并且代码中不涉及到对同一个对象的某个状态或者某个变量的更新操作，那么就表明代码是可以被并行化的。

对于问题3，由于在并行环境中任务的执行顺序是不确定的，因此对于依赖于顺序的任务而言，并行化也许不能给出正确的结果。

