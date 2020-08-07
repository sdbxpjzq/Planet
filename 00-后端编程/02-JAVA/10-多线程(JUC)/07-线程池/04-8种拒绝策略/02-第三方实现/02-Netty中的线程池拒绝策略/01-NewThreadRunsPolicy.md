## NewThreadRunsPolicy

```java
private static final class NewThreadRunsPolicy implements RejectedExecutionHandler {
        private NewThreadRunsPolicy() {
        }

        public void rejectedExecution(Runnable r, ThreadPoolExecutor executor) {
            try {
                Thread t = new Thread(r, "Temporary task executor");
                t.start();
            } catch (Throwable var4) {
                throw new RejectedExecutionException("Failed to start a new thread", var4);
            }
        }
    }
```



Netty中的实现很像JDK中的CallerRunsPolicy，舍不得丢弃任务。

不同的是，CallerRunsPolicy是直接在调用者线程执行的任务。而 Netty是新建了一个线程来处理的。

所以，Netty的实现相较于调用者执行策略的使用面就可以扩展到支持高效率高性能的场景了。

但是也要注意一点，Netty的实现里，在创建线程时未做任何的判断约束，也就是说只要系统还有资源就会创建新的线程来处理，直到new不出新的线程了，才会抛创建线程失败的异常

