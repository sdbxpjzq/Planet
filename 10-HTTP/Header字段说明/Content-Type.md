## GET 请求

**GET 请求不存在请求实体部分，键值对参数放置在 URL 尾部，因此请求头不需要设置 Content-Type 字段**



几个常见的Content-Type:

1.text/html
2.text/plain
3.text/css
4.text/javascript

================下边是post=========

5.application/x-www-form-urlencoded(默认的方式)
6.multipart/form-data(发送文件的POST包)
7.application/json
8.application/xml

## multipart/form-data

```
POST http://www.homeway.me HTTP/1.1
Content-Type:multipart/form-data; boundary=------WebKitFormBoundaryOGkWPJsSaJCPWjZP

------WebKitFormBoundaryOGkWPJsSaJCPWjZP
Content-Disposition: form-data; name="key2"
456
------WebKitFormBoundaryOGkWPJsSaJCPWjZP
Content-Disposition: form-data; name="key1"
123
------WebKitFormBoundaryOGkWPJsSaJCPWjZP
Content-Disposition: form-data; name="file"; filename="index.py"
```

这里`Content-Type`告诉我们，发包是以`multipart/form-data`格式来传输，另外，还有`boundary`用于分割数据。

当文件太长，HTTP无法在一个包之内发送完毕，就需要分割数据，分割成一个一个chunk发送给服务端，

那么`--`用于区分数据快，而后面的数据`633e61ebf351484f9124d63ce76d8469`就是标示区分包作用。





















