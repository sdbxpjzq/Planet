fpm由master和worker组成, 

```shell
kill master 
# 告诉master, 使其主动关闭 fpm, master和worker都关闭,
#fpm不能工作, 返回502

kill -9 master 
# 强制master关闭, worker还在运行,  正常解析php

kill worker
# 告诉worker关闭, 但是此时master又会重新拉起一个新的worker,
# 使其正常解析php

```