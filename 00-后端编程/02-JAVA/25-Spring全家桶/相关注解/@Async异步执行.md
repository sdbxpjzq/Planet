
## 开启异步支持 - `@EnableAsync`
![](https://youpaiyun.zongqilive.cn/image/20200522150004.png)

```java
@Configuration
@EnableAsync
public class SpringAsyncConfig { ... }
```

## @Async

### 无返回值

```java
@Async
public void m1() {
 System.out.println("Execute method asynchronously. "
 + Thread.currentThread().getName());
}
```

### 有返回值

```java
@Async
public Future<String> m2() {
 System.out.println("Execute method asynchronously - "
 + Thread.currentThread().getName());
 try {
 Thread.sleep(5000);
 return new AsyncResult<String>("hello world !!!!");
 } catch (InterruptedException e) {
 //
 }
 
 return null;
}
```


## 执行器
默认情况下，Spring 使用`SimpleAsyncTaskExecutor`去执行这些异步方法（此执行器没有限制线程数）。
此默认值可以从两个层级进行覆盖：

### 方法级别覆盖

```java
@Async("threadPoolTaskExecutor")
public void m1() {
 System.out.println("Execute method with configured executor - "
 + Thread.currentThread().getName());
}
```

### 应用级别覆盖
配置类应该实现AsyncConfigurer接口——这意味着它拥有getAsyncExecutor()方法的实现。
在这里，我们将返回整个应用程序的执行器——这现在成为运行带有@Async注释的方法的默认执行器:
```java
@Configuration
@EnableAsync
public class SpringAsyncConfig implements AsyncConfigurer {
 
 @Override
 public Executor getAsyncExecutor() {
 ThreadPoolTaskExecutor executor = new ThreadPoolTaskExecutor();
 executor.initialize();
 executor.setCorePoolSize(5);
 executor.setMaxPoolSize(10);
 executor.setQueueCapacity(25);
 return executor;
 }
 
}
```

## 异常处理

当方法返回值是`Future`的时候，异常捕获是没问题的 - `Future.get()`方法会抛出异常。

但是，如果返回类型是Void，那么异常在当前线程就捕获不到。因此，我们需要添加额外的配置来处理异常。

我们将通过实现AsyncUncaughtExceptionHandler接口创建一个定制的async异常处理程序。
handleUncaughtException()方法在存在任何未捕获的异步异常时调用:
```java
public class CustomAsyncExceptionHandler
 implements AsyncUncaughtExceptionHandler {
 
 @Override
 public void handleUncaughtException(
 Throwable throwable, Method method, Object... obj) {
 
 System.out.println("Exception message - " + throwable.getMessage());
 System.out.println("Method name - " + method.getName());
 for (Object param : obj) {
 System.out.println("Parameter value - " + param);
 }
 }
 
}
```

configuration类实现的AsyncConfigurer接口。作为其中的一部分，我们还需要覆盖getAsyncUncaughtExceptionHandler()方法来返回我们自定义的异步异常处理程序:
```java
@Override
public AsyncUncaughtExceptionHandler getAsyncUncaughtExceptionHandler() {
 return new CustomAsyncExceptionHandler();
}
```





