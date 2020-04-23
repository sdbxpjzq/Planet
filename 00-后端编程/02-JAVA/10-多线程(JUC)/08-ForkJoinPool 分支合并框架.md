ForkJoin 在 JDK 1.7 ， 并行执行任务！提高效率。大数据量！大数据：Map Reduce （把大任务拆分为小任务）

![](https://youpaiyun.zongqilive.cn/image/20200307175642.png)



## ForkJoin特点：工作窃取



![](https://youpaiyun.zongqilive.cn/image/20200423082751.png)

```java
/**
 * 求和计算的任务！
 * 3000   6000（ForkJoin）  9000（Stream并行流）
 * // 如何使用 forkjoin
 * // 1、forkjoinPool 通过它来执行
 * // 2、计算任务 forkjoinPool.execute(ForkJoinTask task)
 * // 3. 计算类要继承 ForkJoinTask
 */
public class ForkJoinDemo extends RecursiveTask<Long> {

  private Long start;  // 1
  private Long end;    // 1990900000

  // 临界值
  private Long temp = 10000L;

  public ForkJoinDemo(Long start, Long end) {
    this.start = start;
    this.end = end;
  }
  // 计算方法
  @Override
  protected Long compute() {
    if ((end-start)<temp){
      Long sum = 0L;
      for (Long i = start; i <= end; i++) {
        sum += i;
      }
      return sum;
    }else { // forkjoin 递归
      long middle = (start + end) / 2; // 中间值
      ForkJoinDemo task1 = new ForkJoinDemo(start, middle);
      task1.fork(); // 拆分任务，把任务压入线程队列
      ForkJoinDemo task2 = new ForkJoinDemo(middle+1, end);
      task2.fork(); // 拆分任务，把任务压入线程队列

      return task1.join() + task2.join();
    }
  }
}
```

测试

```java
/**
 * 同一个任务，别人效率高你几十倍！
 */
public class Test {
  public static void main(String[] args) throws ExecutionException, InterruptedException {
    // test1(); // 12224
    // test2(); // 10038
    // test3(); // 153
  }

  // 普通程序员
  public static void test1(){
    Long sum = 0L;
    long start = System.currentTimeMillis();
    for (Long i = 1L; i <= 10_0000_0000; i++) {
      sum += i;
    }
    long end = System.currentTimeMillis();
    System.out.println("sum="+sum+" 时间："+(end-start));
  }

  // 会使用ForkJoin 中级程序员
  public static void test2() throws ExecutionException, InterruptedException {
    long start = System.currentTimeMillis();

    ForkJoinPool forkJoinPool = new ForkJoinPool();
    ForkJoinTask<Long> task = new ForkJoinDemo(0L, 10_0000_0000L);
    ForkJoinTask<Long> submit = forkJoinPool.submit(task);// 提交任务
    Long sum = submit.get();

    long end = System.currentTimeMillis();

    System.out.println("sum="+sum+" 时间："+(end-start));
  }
  //牛逼程序员
  public static void test3(){
    long start = System.currentTimeMillis();
    // Stream并行流 ()  (]
    long sum = LongStream.rangeClosed(0L, 10_0000_0000L).parallel().reduce(0, Long::sum);
    long end = System.currentTimeMillis();
    System.out.println("sum="+"时间："+(end-start));
  }
}
```



