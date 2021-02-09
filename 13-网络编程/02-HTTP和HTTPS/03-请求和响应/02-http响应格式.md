# HTTP响应格式

HTTP 响应也是由三个部分组成，分别是：状态行、消息报头和响应正文。

状态行由协议版本、数字形式的状态代码，及相应的状态描述组成，各元素之间以空格分隔，结尾时回车换行符.



如：

```text
HTTP/1.1 200 OK

server: ecstatic-2.2.1
last-modified: Thu, 21 Sep 2017 12:52:05 GMT
etag: "6473557-2233-"2017-09-21T12:52:05.000Z""
cache-control: max-age=3600
content-length: 2233
content-type: text/x-markdown; charset=UTF-8
Date: Thu, 18 Jan 2018 02:13:03 GMT
Connection: keep-alive
```

