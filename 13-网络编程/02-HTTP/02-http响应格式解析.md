# HTTP响应格式

HTTP 响应也是由三个部分组成，分别是：状态行、消息报头和响应正文。如：

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

第一行是状态行

​	状态行由协议版本、数字形式的状态代码，及相应的状态描述组成，各元素之间以空格分隔，结尾时回车换行符.

### Cache头域

#### Date

作用：生成消息的具体时间和日期，即当前的GMT时间。

例如：　`Date: Sun, 17 Mar 2013 08:12:54 GMT`

#### Expires

作用: 	浏览器会在指定过期时间内使用本地缓存，指明应该在什么时候认为文档已经过期，从而不再缓存它。

例如:` Expires: Thu, 19 Nov 1981 08:52:00 GMT　　`

#### Vary

作用：

例如: `Vary: Accept-Encoding`

### Cookie/Login 头域

#### P3P

作用:	 用于跨域设置`Cookie`, 这样可以解决`iframe`跨域访问`cookie`的问题

例如: `P3P: CP=CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR`

#### **Set-Cookie**

作用： 非常重要的`header`, 用于把`cookie` 发送到客户端浏览器， 每一个写入`cookie`都会生成一个`Set-Cookie`.

例如: `Set-Cookie: PHPSESSID=c0huq7pdkmm5gg6osoe3mgjmm3; path=/`



### Entity实体头域：

​	实体内容的属性，包括实体信息类型，长度，压缩方法，最后一次修改时间，数据有效性等。

#### **ETag：**

作用:  和`If-None-Match` 配合使用。 （实例请看上节中If-None-Match的实例）

例如: `ETag: "03f2b33c0bfcc1:0"`

#### **Last-Modified：**

作用： 用于指示资源的最后修改日期和时间。（实例请看上节的If-Modified-Since的实例）

例如: `Last-Modified: Wed, 21 Dec 2011 09:09:10 GMT`

#### **Content-Type：**

作用：WEB服务器告诉浏览器自己响应的对象的类型和字符集,

例如:

​       ` Content-Type: text/html; charset=utf-8`

　　`Content-Type:text/html;charset=GB2312`

　　`Content-Type: image/jpeg`

#### **Content-Length：**

指明实体正文的长度，以字节方式存储的十进制数字来表示。在数据下行的过程中，Content-Length的方式要预先在服务器中缓存所有数据，然后所有数据再一股脑儿地发给客户端。

　　例如: `Content-Length: 19847`

#### **Content-Encoding：**

作用：文档的编码（Encode）方法。一般是压缩方式。

WEB服务器表明自己使用了什么压缩方法（gzip，deflate）压缩响应中的对象。利用gzip压缩文档能够显著地减少HTML文档的下载时间。

例如：`Content-Encoding：gzip`

#### **Content-Language：**

作用： WEB服务器告诉浏览器自己响应的对象的语言者

例如：` Content-Language:da`

### Miscellaneous 头域

#### **Server：**

作用：指明HTTP服务器的软件信息

例如: `Apache/2.2.8 (Win32) PHP/5.2.5`

#### **X-Powered-By：**

作用：表示网站是用什么技术开发的

例如：`X-Powered-By: PHP/5.2.5`

### Transport头域

#### **Connection：**

例如：　`Connection: keep-alive`   当一个网页打开完成后，客户端和服务器之间用于传输HTTP数据的TCP连接不会关闭，如果客户端再次访问这个服务器上的网页，会继续使用这一条已经建立的连接

例如：  `Connection: close`  代表一个Request完成后，客户端和服务器之间用于传输HTTP数据的TCP连接会关闭， 当客户端再次发送Request，需要重新建立TCP连接。



### Location头域

#### **Location：**

作用： 用于重定向一个新的位置， 包含新的URL地址



