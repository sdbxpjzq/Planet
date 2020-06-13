## Weaving：织入

将一个或多个切面与类或对象链接在一起创建一个被增强对象。

织入能发生在编译时 （compile time ）(使用AspectJ编译器)，加载时（load time），或运行时（runtime） 。

Spring AOP默认就是运行时织入，可以通过 `枚举AdviceMode`来设置



