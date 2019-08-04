```php
# session_start 先在服务器创建一个session文件, 然后再把该文件名字响应给客户端
session_start(); // 开启session

# 删除session
unset($_SESSION['name']); // 只删除 name 这个变量
session_destroy();  // 删除整个session文件


```

## session开启

有2种方式

1. `session_start();`
2. 在`php.ini`配置文件中自动开启

调用之前不能有任何的输出，空格和空行都不行.

## session 严格模式

在`php.ini`文件中, 设置 `session.use_strict_mode = 1`.

不接受非服务器创建的session文件名称, 建议开启严格模式, 防止伪造session文件



## session 垃圾回收

在`php.ini`中存在下面几个参数:

`session.gc_probability = 1`,  该项是 除数;

`session.gc_divisor = 1000`,  该项是被除数;

session垃圾回收机制, 不是说一旦过期了就删除, 而是有概率的删除, 那么这个概率就是上边的配置`session.gc_probability / session.gc_divisor`, 即上边的配置概率是 `1/1000`.

`session_gc_maxlifetime = 1400`(秒单位),  该项表示 一旦24分钟之内没有做任何操作, 说明该session文件过期了,  就会触发垃圾回收机制. 删除概率是100%.



## session的存储机制

session的存储分为3阶段:

1. `session_start()`开启阶段

确定浏览器是否携带了session_id, 如果携带了, 就是用浏览器带的, 如果没有带, 则创建session文件, 并把session文件(作为session_id)名称返回给浏览器. 

2.  初始化$_SESSION这个变量

   先读取session文件里边的内容, 再将内容反序列化之后, 赋值给`$_SESSION`这个变量

3. 在`session_start()`时, 判断哪些session文件过期, 然后再触发垃圾回收机制



脚本运行周期内:

 `sesssion_start()`之后, 只是对`$_SESSION`这个变量进行增删改查的操作, 需要注意: 这个阶段并没有影响到`session文件`里边的内容, 除非你在这个阶段执行`session_destroy()`, 除此之外, 该阶段不会对`session文件`有任何影响.

脚本执行结束阶段:

在这个阶段才会对`session文件`进行操作, 也就是这个阶段才会把`$_SESSION`数组中的数据序列化, 然后存储到`session文件`



## 删除所有session相关数据

```php
session_start();

$_SESSION = []; // 清空内存中的数据
session_destroy(); // 删除session文件

setcookie(session_name, '', time()-1); // 设置PHPSESSID过期


```

































































