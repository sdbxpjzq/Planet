- 信号量的主要用户两个目的，一个是用于**共享资源的相互排斥使用** ，另一个是用于**并发资源数的控制**。



- 例子：抢车位问题，此时有六部车辆，但是只有三个车位的问题。

```java
public static void main(String[] args) {
  Semaphore semaphore = new Semaphore(3); //模拟三个车位
  /**模拟六辆车*/
  for (int i = 1; i <= 6; i++) {
    new Thread(()->{
      try {
        semaphore.acquire();   //抢到车位  这时候只能进来三辆车，超过三辆车进不来，等待有车辆离开
        System.out.println(Thread.currentThread().getName()+"\t 抢到车位");
        try { TimeUnit.SECONDS.sleep(3);} catch (InterruptedException e) {e.printStackTrace();}
        System.out.println(Thread.currentThread().getName()+"\t 停车2秒后，离开车位");
      } catch (InterruptedException e) {
        e.printStackTrace();
      } finally {
        semaphore.release();   //释放车位资源
      }
    },i + "号车辆").start();
  }
}
//打印结果
/**
	1号车辆	 抢到车位
	3号车辆	 抢到车位
	2号车辆	 抢到车位
	2号车辆	 停车2秒后，离开车位
	1号车辆	 停车2秒后，离开车位
	3号车辆	 停车2秒后，离开车位
	4号车辆	 抢到车位
	5号车辆	 抢到车位
	6号车辆	 抢到车位
	6号车辆	 停车2秒后，离开车位
	5号车辆	 停车2秒后，离开车位
	4号车辆	 停车2秒后，离开车位
*/

```





