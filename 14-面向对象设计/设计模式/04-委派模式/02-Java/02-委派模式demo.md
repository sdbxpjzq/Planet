```java
public interface IExector {
   //普通员工执行任务
   //在公司中，员工执行任务
   //规定在一周之内必须完成
   void doing();
   
}

```



```java
// 员工A
public class ExectorA implements IExector {

   @Override
   public void doing() {
      System.out.println("员工A开始执行任务");
   }
   
}

// 员工B
public class ExectorB implements IExector{

   @Override
   public void doing() {
      System.out.println("员工B开始执行任务");
   }

}

// 项目经理
public class Dispatcher implements IExector{
   IExector exector;
   
   Dispatcher(IExector exector){
      this.exector = exector;
   }  
   //项目经理，虽然也有执行方法
   //但是他的工作职责是不一样的
   public void doing() {
      this.exector.doing();
   }

}
```





```java
public class DispatcherTest {
  public static void main(String[] args) {
    Dispatcher dispatcher = new Dispatcher(new ExectorA());
    //看上去好像是我们的项目经理在干活
    //但实际干活的人是普通员工
    //这就是典型，干活是我的，功劳是你的
    dispatcher.doing();
  }

}
```





