## AOP proxy：AOP代理

为了实现切面功能一个对象会被AOP框架创建出来。

在Spring框架中AOP代理的默认方式是：有接口，就使用基于接口的JDK动态代理，否则使用基于类的CGLIB动态代理。但是我们可以通过设置 `proxy-target-class="true"`，完全使用CGLIB动态代理。

