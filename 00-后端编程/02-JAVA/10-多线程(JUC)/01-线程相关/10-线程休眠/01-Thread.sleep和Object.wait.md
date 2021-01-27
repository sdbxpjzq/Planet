## Thread.sleep()和Object.wait()的区别

- Thread.sleep()不会释放占有的锁，Object.wait()会释放占有的锁；
- Thread.sleep()必须传入时间，Object.wait()可传可不传，不传表示一直阻塞下去；
- Thread.sleep()到时间了会自动唤醒，然后继续执行；
- Object.wait()不带时间的，需要另一个线程使用Object.notify()唤醒；
- Object.wait()带时间的，假如没有被notify，到时间了会自动唤醒，这时又分好两种情况，一是立即获取到了锁，线程自然会继续执行；二是没有立即获取锁，线程进入同步队列等待获取锁；

- 使用的范围是不同：wait必须在同步代码块中，sleep可以在任何地方睡
- sleep存在异常`InterruptedException`

1. wait()方法必须要在同步方法或者同步块中调用，也就是必须已经获得对象锁。而sleep()方法没有这个限制可以在任何地方种使用。另外，wait()方法会释放占有的对象锁，使得该线程进入等待池中，等待下一次获取资源。而sleep()方法只是会让出CPU并不会释放掉对象锁；
2. sleep()方法在休眠时间达到后如果再次获得CPU时间片就会继续执行，而wait()方法必须等待Object.notift/Object.notifyAll通知后，才会离开等待池，并且再次获得CPU时间片才会继续执行。

其实，他们俩最大的区别就是Thread.sleep()不会释放锁资源，Object.wait()会释放锁资源。





上次的文章我们已经看过了 sleep 的源码了，它们的相同点主要有：

- 它们都可以改变线程状态，让其进入计时等待。
- 它们都可以响应 interrupt 中断，并抛出 InterruptedException 异常。

不同点：

- wait 是 Object 类的方法，而 sleep 是 Thread 类的方法。
- wait 方法必须在 synchronized 保护的代码中使用，而 sleep 方法可在任意地方。
- 调用 sleep 方法不释放 monitor 锁，调用 wait 方法，会释放 monitor 锁。
- sleep 时间一到马上恢复执行（因为没有释放锁）；wait 需要等中断，或者对应对象的 notify 或 notifyAll 才会恢复，抢到锁才会执行（唤醒多个的情况）。