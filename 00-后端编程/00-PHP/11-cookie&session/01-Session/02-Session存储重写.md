## session的3种保存方式

```php
session.save_handler = files || user || memcache
```

## 修改配置

修改配置文件, 将session存储机制修改为`user`(自定义).

或者设置  `init_set('session.save_handler', 'user')`



## session_set_save_handler()说明

```php
session_set_save_handler ($open, $close, $read, $write, $destroy, $gc, $create_sid = null, $validate_sid = null,  $update_timestamp = null)
```

参数1:`$open`表示 session_start的时候, 怎么处理

参数2: `$close`, 表示脚本结束的时候怎么处理

参数3: `$read`, 表示读取 session 数据的处理函数

参数4: `$write`, 表示session写入的处理函数

参数5: `$destroy`, 表示session销毁的处理函数

参数6: `$gc`, 表示session 过期之后的处理函数



代码实现:

```php
function open()
{
    // 初始化数据库链接
    $link = mysql_connect('127.0.0.1', 'root', 'root');
    mysqli_select_db('zongqi');
    mysql_query('set names utf8');
}

function close()
{
    echo '脚本结束了...';
    return true;
}

function read($sess_id)
{
    // 查询 $sess_id 的内容
    $sql = "select sess_content from session where sess_id = {$sess_id}";
    $result = mysql_query($sql);
    $ret = mysql_fetch_assoc($result);
    return $ret['sess_content'];
}

function write($sess_id, $sess_content)
{
    // inset into  写入表
    return true;
}

function destroy($sess_id)
{
    // delete 删除表
    return true;
}

function gc($max_lifetime)
{
    $time = time() - $max_lifetime;
    $sql = " delete from session where last_time < {$time}";
    return mysql_query($sql);
}

session_set_save_handler('open', 'close', 'read', 'write', 'destroy', 'gc');


```















































