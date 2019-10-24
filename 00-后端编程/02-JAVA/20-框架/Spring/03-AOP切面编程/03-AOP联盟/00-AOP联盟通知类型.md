AOP联盟为通知Advice定义了`org.aopalliance.aop.Advice`

Spring按照通知Advice在目标类方法的连接点位置，可以分为`5类`

1. 前置通知`org.springframework.aop.MethodBeforeAdvice`

    •在目标方法执行前实施增强

2. 后置通知` org.springframework.aop.AfterReturningAdvice`

   ​    •在目标方法执行后实施增强 

3. 环绕通知` org.aopalliance.intercept.MethodInterceptor`

   ​    •在目标方法执行前后实施增强 

4. 异常抛出通知`org.springframework.aop.ThrowsAdvice`

   ​    •在方法抛出异常后实施增强

5. 引介通知` org.springframework.aop.IntroductionInterceptor`

   ​    在目标类中添加一些新的方法和属性



```
环绕通知，必须手动执行目标方法
try{
   //前置通知
   //执行目标方法
   //后置通知
} catch(){
   //抛出异常通知
}
```



