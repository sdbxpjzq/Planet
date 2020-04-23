进程：一个程序，QQ.exe  Music.exe  程序的集合；
一个进程往往可以包含多个线程，至少包含一个！

## Java默认有几个线程

2 个,   mian和GC



Java 真的可以开启线程吗？开不了，我们看看源码

```java
public synchronized void start() {
        /**
         * This method is not invoked for the main method thread or "system"
         * group threads created/set up by the VM. Any new functionality added
         * to this method in the future may have to also be added to the VM.
         *
         * A zero status value corresponds to state "NEW".
         */
        if (threadStatus != 0)
            throw new IllegalThreadStateException();

        /* Notify the group that this thread is about to be started
         * so that it can be added to the group's list of threads
         * and the group's unstarted count can be decremented. */
        group.add(this);

        boolean started = false;
        try {
            start0();
            started = true;
        } finally {
            try {
                if (!started) {
                    group.threadStartFailed(this);
                }
            } catch (Throwable ignore) {
                /* do nothing. If start0 threw a Throwable then
                  it will be passed up the call stack */
            }
        }
    }
    //本地方法，底层C++,java 无是无法直接操作硬件的
    private native void start0();
```

## 并发、并行

并发编程：并发、并行

- 并发（多线程操作同一个资源）
    CPU 一核 ，模拟出来多条线程，天下武功，唯快不破，快速交替
- 并行（多个人一起行走）
    CPU 多核 ，多个线程可以同时执行；线程池

```java
// 获取cpu的核数
// CPU 密集型，IO密集型
Runtime.getRuntime().availableProcessors();
```





















