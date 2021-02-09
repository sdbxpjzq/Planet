
# HTTP详解

## HTTP请求三部分组成

HTTP 请求由三部分组成：请求行、  请求头和请求体。

1. 请求行

   请求方法 URI 协议/版本

2. 请求头(Request Header)

3. 请求体

## 示例说明

下面是一个HTTP请求的示例:

```text
GET /index.php HTTP/1.1

Host: 127.0.0.1:8080
Connection: keep-alive
Pragma: no-cache
Cache-Control: no-cache
Upgrade-Insecure-Requests: 1
User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8
Referer: http://127.0.0.1:8080/
Accept-Encoding: gzip, deflate, br
Accept-Language: zh-CN,zh;q=0.9,en;q=0.8
```

1. 请求的第一行是“方法 URL  协议/版本”，并以 回车换行作为结尾。请求行以空格分隔。



## http1.1支持的请求方法

HTTP1.1 中的请求方式：

| 方法      | 作用                                       |
| ------- | ---------------------------------------- |
| GET     | 请求获取由 Request-URI 所标识的资源                 |
| POST    | 请求服务器接收在请求中封装的实体，并将其作为由 Request-Line 中的 Request-URI 所标识的资源的一部分 |
| HEAD    | 请求获取由 Request-URI 所标识的资源的响应消息报头          |
| PUT     | 请求服务器存储一个资源，并用 Request-URI 作为其标识符        |
| DELETE  | 请求服务器删除由 Request-URI 所标识的资源              |
| TRACE   | 请求服务器回送到的请求信息，主要用于测试或诊断                  |
| CONNECT | 保留将来使用                                   |
| OPTIONS | 请求查询服务器的性能，或者查询与资源相关的选项和需求               |


