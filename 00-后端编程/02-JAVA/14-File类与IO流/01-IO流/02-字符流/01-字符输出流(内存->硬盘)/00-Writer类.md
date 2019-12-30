`java.io.writer`: 字符输出流, 是所有字符输出流的最顶层的父类, 是一个抽象类.



## 方法

\- `void write(int c)` 写入单个字符。

\- `void write(char[] cbuf) `写入字符数组。 

\- `abstract void write(char[] cbuf, int off, int len) `写入字符数组的某一部分,off数组的开始索引,len写的字符个数。 

\- `void write(String str) `写入字符串。 

\- `void write(String str, int off, int len)` 写入字符串的某一部分,off字符串的开始索引,len写的字符个数。

\- `void flush() `刷新该流的缓冲。 

\- `void close()` 关闭此流，但要先刷新它。 















