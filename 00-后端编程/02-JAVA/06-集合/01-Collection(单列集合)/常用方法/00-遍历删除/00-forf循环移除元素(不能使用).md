```java
List<String> list = new ArrayList<>();
    list.add("Felordcn");
    list.add("Tomcat");
    list.add("Jetty");
    list.add("Undertow");
    list.add("Resin");
```
## for 循环移除元素

### 情况1

```cpp
for(int i=0,len=list.size();i< len;i++){
    if(list.get(i).equals("del")){
       list.remove(i);
       --len;//减少一个
       //此时要注意,因为list会动态变化不像数组会占位,所以当前索引应该后退一位
       --i;
     }
}
```

上面这种方式会抛出`java.lang.IndexOutOfBoundsException`异常。这种方式的问题在于，删除某个元素后，list的大小发生了变化，而你的索引也在变化。



### 情况2

让我们使用传统的 `foreach` 循环移除 `F`开头的假服务器，但是你会发现这种操作引发了
`ConcurrentModificationException`异常。

```java
// 错误的示范 千万不要使用
for (String s : list) {
  if (s.startsWith("F")) {
    list.remove(s);
  }
}
```

从List中删除数据以后，继续循环List时会导致List的next()方法内部出现modCount和expectedModCount不一致(modCount++，而expectedCount值未变)，导致抛出`ConcurrentModificationException`，导致抛出异常。

> modCount是List对象的一个成员变量，它代表该List对象被修改的次数，每对List对象修改一次，modCount都会加1。而expectedModCount是Iterator类里的一个成员变量，创建迭代器的时候将当时的modCount赋值给expectedModCount，随后迭代过程中会检查这个值，一旦发现这个值发生变化，就说明你对容器做了修改，就会抛异常。



难道 for 循环就不能移除元素了吗？当然不是！我们如果能确定需要被移除的元素的`索引`还是可以的。

```java
// 这种方式是可行
for (int i = 0; i < list.size(); i++) {
  if (list.get(i).startsWith("F")) {
    list.remove(i);
  }
}
```