```
1、flag变量被volatile修饰了；
2、当线程2对flag做assign操作后需要立即写回主内存；
3、在store之前，该lock指令会对内存中的变量flag加一把锁；
4、当store操作将flag值写回主内存时候，需要通过CPU总线，这个时候会触发总线嗅探机制，通知其他CPU缓存失效；
5、执行write成功后，会执行unlock释放锁。
```

以发现**锁粒度小很多了，只在store时候加锁**

