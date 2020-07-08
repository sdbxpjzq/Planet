**stop()方法会真的杀死线程。**

如果线程持有ReentrantLock锁，被stop()的线程并不会自动调用ReentrantLock的unlock()去释放锁，那其他线程就再也没机会获得ReentrantLock锁， 这样其他线程就再也不能执行ReentrantLock锁锁住的代码逻辑。所以该方法就不建议使用了， 类似的方法还有suspend()和resume()方法， 这两个方法同样也都不建议使用了 。

