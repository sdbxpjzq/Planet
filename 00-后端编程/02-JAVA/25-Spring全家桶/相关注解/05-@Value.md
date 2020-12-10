## 注入静态变量

### 给参数注入，执行set方法

自动生成的`setter`方法，会带有**`static`**的限定符，需要去掉，才可以。

```java
@Component
public class EnvUtils {

    private static String env;

    @Value("${spring.profiles.active}")
    public void setEnv(String active) { // 去掉 static
        EnvUtils.env = active;
    }

    public static Boolean isDevEnv() {
        System.out.println(EnvUtils.env);
        return "development".equals(EnvUtils.env);
    }
}

```

### 通过中间变量赋值

```java
public static String zhifuUrl; 
@Value("${zhifu.url}")
private String zhifuUrlTmp;
 
@PostConstruct
public void init() {
zhifuUrl = zhifuUrlTmp;
}

```

