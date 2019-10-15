URL还有一个高级特性——批处理句柄（handle）。这一特性允许你同时或异步地打开多个URL连接。

```php
// 创建两个cURL资源
$ch1 = curl_init();
$ch2 = curl_init();
// 指定URL和适当的参数
curl_setopt($ch1, CURLOPT_URL, "http://lxr.php.net/");
curl_setopt($ch1, CURLOPT_HEADER, 0);
curl_setopt($ch2, CURLOPT_URL, "http://www.php.net/");
curl_setopt($ch2, CURLOPT_HEADER, 0);
// 创建cURL批处理句柄
$mh = curl_multi_init();
// 加上前面两个资源句柄
curl_multi_add_handle($mh,$ch1);
curl_multi_add_handle($mh,$ch2);
// 预定义一个状态变量
$active = null;
// 执行批处理
do {
    $mrc = curl_multi_exec($mh, $active);
} while ($mrc == CURLM_CALL_MULTI_PERFORM);
while ($active && $mrc == CURLM_OK) {
    if (curl_multi_select($mh) != -1) {
        do {
            $mrc = curl_multi_exec($mh, $active);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);
    }
}
// 关闭各个句柄
curl_multi_remove_handle($mh, $ch1);
curl_multi_remove_handle($mh, $ch2);
curl_multi_close($mh);
```



例子:

```php
// 1. 批处理器
$mh = curl_multi_init();
// 2. 加入需批量处理的URL
for ($i = 0; $i < $max_connections; $i++) {
    add_url_to_multi_handle($mh, $url_list);
}
// 3. 初始处理
do {
    $mrc = curl_multi_exec($mh, $active);
} while ($mrc == CURLM_CALL_MULTI_PERFORM);
// 4. 主循环
while ($active && $mrc == CURLM_OK) {
    // 5. 有活动连接
    if (curl_multi_select($mh) != -1) {
        // 6. 干活
        do {
            $mrc = curl_multi_exec($mh, $active);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);
        // 7. 有信息否？
        if ($mhinfo = curl_multi_info_read($mh)) {
            // 意味着该连接正常结束
            // 8. 从curl句柄获取信息
            $chinfo = curl_getinfo($mhinfo['handle']);
            // 9. 死链么？
            if (!$chinfo['http_code']) {
                $dead_urls []= $chinfo['url'];
            // 10. 404了?
            } else if ($chinfo['http_code'] == 404) {
                $not_found_urls []= $chinfo['url'];
            // 11. 还能用
            } else {
                $working_urls []= $chinfo['url'];
            }
            // 12. 移除句柄
            curl_multi_remove_handle($mh, $mhinfo['handle']);
            curl_close($mhinfo['handle']);
            // 13. 加入新URL，干活
            if (add_url_to_multi_handle($mh, $url_list)) {
                do {
                    $mrc = curl_multi_exec($mh, $active);
                } while ($mrc == CURLM_CALL_MULTI_PERFORM);
            }
        }
    }
}
// 14. 完了
curl_multi_close($mh);
echo "==Dead URLs==\n";
echo implode("\n",$dead_urls) . "\n\n";
echo "==404 URLs==\n";
echo implode("\n",$not_found_urls) . "\n\n";
echo "==Working URLs==\n";
echo implode("\n",$working_urls);
// 15. 向批处理器添加url
function add_url_to_multi_handle($mh, $url_list) {
    static $index = 0;
    // 如果还剩url没用
    if ($url_list[$index]) {
        // 新建curl句柄
        $ch = curl_init();
        // 配置url
        curl_setopt($ch, CURLOPT_URL, $url_list[$index]);
        // 不想输出返回的内容
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 重定向到哪儿我们就去哪儿
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        // 不需要内容体，能够节约带宽和时间
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        // 加入到批处理器中
        curl_multi_add_handle($mh, $ch);
        // 拨一下计数器，下次调用该函数就能添加下一个url了
        $index++;
        return true;
    } else {
        // 没有新的URL需要处理了
        return false;
    }
}
```



1. 新建一个批处理器。Created a multi handle.
2. 稍后我们将创建一个把URL加入批处理器的函数 add_url_to_multi_handle() 。每当这个函数被调用，就有一个新url被加入批处理器。一开始，我们给批处理器添加了10个URL（这一数字由 $max_connections 所决定）。
3.  运行 curl_multi_exec() 进行初始化工作是必须的，只要它返回 CURLM_CALL_MULTI_PERFORM 就还有事情要做。这么做主要是为了创建连接，它不会等待完整的URL响应。
4. 只要批处理中还有活动连接主循环就会一直持续。
5. curl_multi_select() 会一直等待，直到某个URL查询产生活动连接。
6. cURL的活儿又来了，主要是获取响应数据。
7. 检查各种信息。当一个URL请求完成时，会返回一个数组。
8. 在返回的数组中有一个 cURL 句柄。我们利用其获取单个cURL请求的相应信息。
9. 如果这是一个死链或者请求超时，不会返回http状态码。
10. 如果这个页面找不到了，会返回404状态码。
11. 其他情况我们都认为这个链接是可用的（当然，你也可以再检查一下500错误之类...）。
12. 从该批次移除这个cURL句柄，因为它已经没有利用价值了，关了它！
13. 很好，现在可以另外加一个URL进来了。再一次地，初始化工作又开始进行...
14. 嗯，该干的都干了。关闭批处理器，生成报告。
15. 回过头来看给批处理器添加新URL的函数。这个函数每调用一次，静态变量 $index 就递增一次，这样我们才能知道还剩多少URL没处理。

