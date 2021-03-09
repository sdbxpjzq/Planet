## setNX

```php

/**
     * 加锁
     * @param $sKey
     * @param $expTime int 秒
     * @return bool
     */
    public static function bSet($sKey, $expTime)
    {
        $isLock = MControl_Tool_Tool::oRedis()->bSetNX($sKey, time() + $expTime);
        if ($isLock) {
            return true;
        } else {
            //加锁失败的情况下。判断锁是否已经存在，如果锁存在切已经过期，那么删除锁。进行重新加锁

            $val = MControl_Tool_Tool::oRedis()->vGet($sKey);

            if ($val && $val < time()) {
                MControl_Tool_Tool::oRedis()->iDel($sKey);
            }
            return MControl_Tool_Tool::oRedis()->bSetNX($sKey, time() + $expTime);
        }
    }

    /**
     * 删除锁
     * @param $sKey
     */
    public static function vDel($sKey)
    {
        MControl_Tool_Tool::oRedis()->iDel($sKey);
    }

```