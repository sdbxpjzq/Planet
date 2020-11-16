## set

`SET key_name my_random_value NX PX 30000`
`NX` 表示if not exist 就设置并返回True，否则不设置并返回False
`PX` 表示过期时间用`毫秒级`， 30000 表示这些毫秒时间后此key过期

需要高版本

```php
public static function set($key, $expTime)
{
        return self::oRedis()->set($key, time() ,['nx', 'ex' => $expTime]);
}


```







