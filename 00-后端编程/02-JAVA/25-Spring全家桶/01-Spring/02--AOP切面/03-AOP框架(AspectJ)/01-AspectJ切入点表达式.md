## AspectJ

![](https://youpaiyun.zongqilive.cn/image/20200625091751.png)



![](https://youpaiyun.zongqilive.cn/image/20200625092153.png)

```
定义切入点表达式  ： execution (* com.sample.service.impl..*.*(..))

execution()是最常用的切点函数，其语法如下所示：

 整个表达式可以分为五个部分

 1、execution(): 表达式主体。

 2、第一个*号：表示返回类型，*号表示所有的类型。

 3、包名：表示需要拦截的包名，后面的两个句点分别表示当前包和当前包的所有子包，com.sample.service.impl包、子孙包下所有类的方法。

 4、第二个*号：表示类名，*号表示所有的类。

 5、*(..) : 第三个星号表示方法名，*号表示所有的方法，后面括弧里面表示方法的参数，两个句点表示任何参数。
```







```java
举例:
execution(public * *(..))
// 指定切入点为:任意公共方法。

execution(* set*(..))
指定切入点为:任何一个以“set”开始的方法。 execution(* com.xyz.service.*.*(..))
指定切入点为:定义在 service 包里的任意类的任意方法。 execution(* com.xyz.service..*.*(..))
指定切入点为:定义在 service 包或者子包里的任意类的任意方法。“..”出现在类名中时，后 面必须跟“*”，表示包、子包下的所有类。

execution(* *..service.*.*(..))
指定所有包下的 serivce 子包下所有类(接口)中所有方法为切入点

execution(* *.service.*.*(..))
指定只有一级包下的 serivce 子包下所有类(接口)中所有方法为切入点

execution(* *.ISomeService.*(..))
指定只有一级包下的 ISomeSerivce 接口中所有方法为切入点

execution(* *..ISomeService.*(..))
指定所有包下的 ISomeSerivce 接口中所有方法为切入点

execution(* com.xyz.service.IAccountService.*(..))
指定切入点为:IAccountService 接口中的任意方法。

execution(* com.xyz.service.IAccountService+.*(..))
指定切入点为:IAccountService 若为接口，则为接口中的任意方法及其所有实现类中的任意 方法;若为类，则为该类及其子类中的任意方法。

execution(* joke(String,int)))
指定切入点为:所有的 joke(String,int)方法，且 joke()方法的第一个参数是 String，第二个参 数是 int。如果方法中的参数类型是 
java.lang 包下的类，可以直接使用类名，否则必须使用 全限定类名，如 joke( java.util.List, int)。

execution(* joke(String,*)))
指定切入点为:所有的 joke()方法，该方法第一个参数为 String，第二个参数可以是任意类 型，如joke(String s1,String s2)和joke(String s1,double d2)都是，但joke(String s1,double d2,String s3)不是。


execution(* joke(String,..)))
指定切入点为:所有的 joke()方法，该方法第一个参数为 String，后面可以有任意个参数且 参数类型不限，如 joke(String s1)、joke(String s1,String s2)和 joke(String s1,double d2,String s3) 都是。

execution(* joke(Object))
指定切入点为:所有的 joke()方法，方法拥有一个参数，且参数是 Object 类型。joke(Object ob) 是，但，joke(String s)与 joke(User u)均不是。

execution(* joke(Object+)))
指定切入点为:所有的 joke()方法，方法拥有一个参数，且参数是 Object 类型或该类的子类。 不仅 joke(Object ob)是，joke(String s)和 joke(User u)也是。

```











# execution() 

用于描述方法 【掌握】

语法：`execution(修饰符 返回值 包.类.方法名(参数) throws异常)  `

## 修饰符, 一般省略

`public`: 公共方法

`*`  :      任意

## 返回值，不能省略

` void`:  返回没有值

 `String `:  返回值字符串

   ` *  ` :     任意

## 包,省略

  `  com.gyf.crm    `     固定包

   ` com.gyf.crm.*.service`:   `crm`包下面子包任意 （例如：`com.gyf.crm.staff.service`）

​    `com.gyf.crm.. `:   ` crm`包下面的所有子包（含自己）

  `  com.gyf.crm.*.service.. `: `crm`包下面任意子包，固定目录service，service目录任意包

## 类,省略

   ` UserServiceImpl `:         指定类

  `  *Impl    `             以Impl结尾

   ` User*`         以User开头

   ` * `            任意

## 方法名，不能省略

​    `addUser`    固定方法

​    `add*  `          以add开头

​    `*Do  `         以Do结尾

​    `*`          任意

## 参数

   ` () `         无参

​    `(int)`       一个整型

​    `(int ,int)`      两个

​    `(..) `         参数任意

## throws ,可省略，一般不写

 

# 案例1

`execution(* com.gyf.crm.*.service..*.*(..))`

#  案例2

```
<aop:pointcut expression="execution(* com.gyf.crm.service.*.*(..)) || execution(* com.gyf.*Do.*(..))" id="myPointCut"/>

```



## within:

匹配包或子包中的方法(了解)
`within(com.gyf.aop..*)`

## this:

匹配实现接口的代理对象中的方法(了解)
`this(com.gyf.aop.user.UserDAO)`

## target:

匹配实现接口的目标对象中的方法(了解)
`target(com.gyf.aop.user.UserDAO)`

## args:

匹配参数格式符合标准的方法(了解)
`args(int,int)`

## bean(id)  

对指定的bean所有的方法(了解)
`bean('userServiceId')`






