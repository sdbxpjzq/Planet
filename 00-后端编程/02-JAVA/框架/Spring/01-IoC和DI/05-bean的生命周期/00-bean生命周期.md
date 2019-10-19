```
1.instantiate bean对象实例化

2.populate properties 封装属性

3.如果Bean实现BeanNameAware 执行 setBeanName

4.如果Bean实现BeanFactoryAware 执行setBeanFactory ，获取Spring容器

5.如果存在类实现 BeanPostProcessor（后处理Bean） ，执行postProcessBeforeInitialization

6.如果Bean实现InitializingBean 执行 afterPropertiesSet

7.调用<bean init-method="init"> 指定初始化方法 init

8.如果存在类实现 BeanPostProcessor（处理Bean） ，执行postProcessAfterInitialization


执行业务处理

9.如果Bean实现 DisposableBean 执行 destroy

101.调用<bean destroy-method="customerDestroy"> 指定销毁方法 customerDestroy
```

```java
public class User implements BeanNameAware,BeanFactoryAware,InitializingBean,DisposableBean{

    private String username;
    private String password;

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        System.out.println("2.赋值属性:" + username);
        this.username = username;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public User() {
        System.out.println("1.实例化....");
    }

    @Override
    public String toString() {
        return "User{" +
                "username='" + username + '\'' +
                ", password='" + password + '\'' +
                '}';
    }

    @Override
    public void setBeanName(String s) {
        System.out.println("3.设置bean名字:" + s);
    }


    @Override
    public void setBeanFactory(BeanFactory beanFactory) throws BeansException {
        //把对象放进工厂，放进容器
        System.out.println("4.bean工厂:" + beanFactory);
    }

    @Override
    public void afterPropertiesSet() throws Exception {

        System.out.println("6.属性赋值完成...");
    }

    public  void myInit(){
        System.out.println("7.自定义的初始化方法...");
    }

    @Override
    public void destroy() throws Exception {
        //资源释放
        System.out.println("9.bean被销毁");
    }

    public void myDestroy(){
        //资源释放
        System.out.println("10.自定义的销毁方法");
    }
}
```

![](https://pic.superbed.cn/item/5da91cb1451253d1781edeb6.jpg)

![](https://pic.superbed.cn/item/5da91cd1451253d1781ee5c7.jpg)

![](https://pic.superbed.cn/item/5da91ce5451253d1781eea61.jpg)



