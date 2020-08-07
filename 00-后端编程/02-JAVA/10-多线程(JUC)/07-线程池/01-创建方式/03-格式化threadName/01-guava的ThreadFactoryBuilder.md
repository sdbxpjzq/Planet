引入依赖

```xml
<dependency>
  <groupId>com.google.guava</groupId>
  <artifactId>guava</artifactId>
  <version>25.1-jre</version>
</dependency>

```



guava的ThreadFactoryBuilder可以传入一个namFormat参数用户来表示线程的name，它内部会使用数字增量表示`%d`

比如一下的nameFormat，10个线程，名字分别是thread-call-runner-1，thread-call-runner-2 … thread-call-runner-10:

```java
private ThreadFactory threadFactory = new ThreadFactoryBuilder().setNameFormat("goods-task-%d").build();
private ExecutorService executorService = new ThreadPoolExecutor(100, 100, 5, TimeUnit.SECONDS, new ArrayBlockingQueue(9000), threadFactory);
```

