## minor GC和 Full GC的区别

- 普通GC(minor GC): 只针对新生代区域的GC, 指发生在新生代的垃圾手机动作, 因为大多数Java对象存活率都不高, 所以`Minor GC`非长频繁, 一版回收速度也比较快
- 全局GC(Full GC):  指发生代老年代的垃圾收集动作, 出现了`Full GC`, 经常会伴随至少一次的`Minor GC`(但不是绝对的), `Full GC`的速度一般要比`Minor GC`慢上10倍以上(因为养老区比较大, 占堆的2/3).