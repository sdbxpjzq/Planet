

```php
# 设置cookie
setcookie('name', 'zongqi', time() +1);

# 删除cookie,  将时间设置过去时间, 就会自动触发浏览器的cookie删除机制
setcookie('name', '', time()-1);
unset($_COOKIE['name']);
```

​	Cookie默认每个域名下最多创建20个cookie, 每个cookie文件最多存储4k左右的数据, chrome浏览器创建的cookie更大 18k.

## setcookie 前面不能有任何的输出

setcookie 前面不能有任何的输出, echo, var_dump 等. 因为setcookie是服务器告诉浏览器的, 告诉浏览器在自己身上创建cookie文件, 服务器向浏览器回应信息是通过header头信息回应的.(echo 等已经把header头信息发送了)



## setcookie的7个参数

```php
function setcookie ($name, $value = "", $expire = 0, $path = "", $domain = "", $secure = false, $httponly = false) {}

```

参数1: cookie变量名

参数2: 变量值

参数3: cookie文件有效期

参数4: 有效路径 (设置`/`, 表示在整个服务器的目录下都起作用)

参数5: 有效域名(cookie 不支持跨域, 可以指定cook在哪个域名下起作用)[如设置`zongqilive.cn`这个域名, 就表示当前域名和子域名都可以使用]

参数6: 是否只允许在https协议下使用

参数7: 是否只允许在http协议下传输(为了防止cookie被劫持)





























