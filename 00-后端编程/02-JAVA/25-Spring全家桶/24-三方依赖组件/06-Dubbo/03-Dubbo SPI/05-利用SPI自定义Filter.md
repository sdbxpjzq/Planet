![](https://youpaiyun.zongqilive.cn/image/20210122152450.png)

```
firstFilter=com.tuling.dubbo.ProviderHelloFilter
```



```java
import org.apache.dubbo.common.constants.CommonConstants;
import org.apache.dubbo.common.extension.Activate;
import org.apache.dubbo.rpc.*;

// spi
@Activate(group = {CommonConstants.PROVIDER, CommonConstants.CONSUMER})
public class ProviderHelloFilter implements Filter {

  @Override
  public Result invoke(Invoker<?> invoker, Invocation invocation) throws RpcException {
    System.out.println("hello ok====================================>>>>>");
    return invoker.invoke(invocation);
  }
}
```

