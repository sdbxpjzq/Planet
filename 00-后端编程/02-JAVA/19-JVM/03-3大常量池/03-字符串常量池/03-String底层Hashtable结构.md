

- String的String Pool是一个固定大小的HashTable, 默认值大小长度是 1009, 
- 如果放进String Pool的String非常多, 就会造成Hash冲突严重, 从而导致链表会很长, 而链表长了后直接造成调用`String.intern`时性能大幅下降
- 使用`-XX:StringTableSize`可以设置StringTable的长度
- 在JDK6中StringTable是固定的, 就是1009的长度, 所以如果常量池中的字符串过多就会导致效率降低,  StringTableSize设置没有要求
- 在JDK7中,StringTableSize的==长度默认值是60013==, StringTableSize设置没有要求
- JDK8开始, 设置StringTableSize的长度, 1009 是可设置的最小值







