
# HTTP详解

## HTTP请求三部分组成

HTTP 请求由三部分组成：请求行、  请求头和请求正文。

1. 请求行

   请求方法 URI 协议/版本

2. 请求头(Request Header)

3. 请求正文

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

### Transport 头域

#### Connection

作用：表示是否需要持久连接。

HTTP 1.1默认进行持久连接.

例如：　`Connection: keep-alive`   当一个网页打开完成后，客户端和服务器之间用于传输HTTP数据的TCP连接不会关闭，如果客户端再次访问这个服务器上的  网页，会继续使用这一条已经建立的连接

例如：  `Connection: close ` 代表一个Request完成后，客户端和服务器之间用于传输HTTP数据的TCP连接会关闭，  当客户端再次发送Request，需要重新建立TCP连接。

​	利用持久连接的优点，当页面包含多个元素时（例如Applet，图片），显著地减少下载所需要的时间。要实现这一点，服务器需要在应答中发送一个`content-length`头.

#### Host

发送请求时，该报头域是必需的

Host请求报头域主要用于指定被请求资源的Internet主机和端口号，它通常从HTTP URL中提取出来的。

`http://localhost/index.html`
浏览器发送的请求消息中，就会包含Host请求报头域，如下：
`Host：localhost`

此处使用缺省端口号`80`，若指定了端口号`8080`，则变成：`Host：localhost:8080`

### Client 头域

#### Accept

`Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8`

作用：浏览器可以接受的媒体类型（MIME类型）,

例如：  `Accept: text/html`  代表浏览器可以接受服务器回发的类型为 text/html  也就是我们常说的html文档, 如果服务器无法返回text/html类型的数据，服务器应该返回一个406错误(non acceptable)。

​	通配符` *` 代表任意类型。例如 ` Accept: */*`  代表浏览器可以处理所有类型，(一般浏览器发给服务器都是发这个)

#### Accept-Encoding

`Accept-Encoding: gzip, deflate`

作用： 浏览器申明自己接收的编码方法，通常指定压缩方法，是否支持压缩，支持什么压缩方法（`gzip`，`deflate`）（注意：这不是指字符编码）;

例如： `Accept-Encoding: gzip, deflate`。Server能够向支持gzip/deflate的浏览器返回经gzip或者deflate编码的HTML页面。 许多情形下这可以减少5到10倍的下载时间，也节省带宽。

#### Accept-Language

`Accept-Language: zh-CN,zh;q=0.9,en;q=0.8`

作用： 浏览器申明自己接收的语言。 

例如：` Accept-Language:zh-cn `, 如果请求消息中没有设置这个报头域，服务器假定客户端对各种语言都可以接受。

#### User-Agent

作用：告诉HTTP服务器， 客户端使用的操作系统和浏览器的名称和版本.



#### Accept-Charset

作用：浏览器申明自己接收的字符集

例如：`Accept-Charset:iso-8859-1,gb2312`.如果在请求消息中没有设置这个域，缺省是任何字符集都可以接受。

#### Authorization

授权信息，通常出现在对服务器发送的`WWW-Authenticate`头的应答中；

`Authorization`请求报头域主要用于证明客户端有权查看某个资源。当浏览器访问一个页面时，如果收到服务器的响应代码为401（未授权），可以发送一个包含Authorization请求报头域的请求，要求服务器对其进行验证。

### Cookie/Login 头域

#### Cookie

作用： 最重要的header, 将cookie的值发送给HTTP 服务器

### Entity头域

#### Content-Length

作用：发送给HTTP服务器数据的长度。即请求消息正文的长度；

例如： `Content-Length: 38`

#### Content-Type

作用： 指定数据类型

例如：`Content-Type: application/x-www-form-urlencoded`

### Miscellaneous 头域

#### Referer

作用： 提供了Request的上下文信息的服务器，告诉服务器我是从哪个链接过来的，比如从我主页上链接到一个朋友那里， 他的服务器就能够从HTTP Referer中统计出每天有多少用户点击我主页上的链接访问    他的网站。

### Cache 头域

#### If-Modified-Since

作用： 把浏览器端缓存页面的最后修改时间发送到服务器去，服务器会把这个时间与服务器上实际文件的最后修改时间进行对比。如果时间一致，那么返回304，客户端就直接使用本地缓存文件。如果时间不一致，就会返回200和新的文件内容。客户端接到之后，会丢弃旧文件，把新文件缓存起来，并显示在浏览器中。

例如：`If-Modified-Since: Thu, 09 Feb 2012 09:07:57 GMT`

#### If-None-Match

作用: 	`If-None-Match`和`ETag`一起工作，工作原理是在`HTTP Response`中添加`ETag`信息。 当用户再次请求该资源时，将在`HTTP Request` 中加入`If-None-Match`信息(ETag的值)。如果服务器验证资源的ETag没有改变（该资源没有更新），将返回一个304状态告诉客户端使用本地缓存文件。否则将返回200状态和新的资源和Etag.  使用这样的机制将提高网站的性能

例如: `If-None-Match: "03f2b33c0bfcc1:0"`

#### Pragma

```text
Pragma: no-cache
Cache-Control: no-cache
```

作用： 防止页面被缓存， 在HTTP/1.1版本中，它和`Cache-Control:no-cache`作用一模一样

`Pargma`只有一个用法， 例如： `Pragma: no-cache`

>  注意: 在HTTP/1.0版本中，只实现了Pragema:no-cache, 没有实现Cache-Control

#### Cache-Control

作用: 	这个是非常重要的规则。 这个用来指定`Response-Request`遵循的缓存机制。各个指令含义如下

`Cache-Control:Public`  可以被任何缓存所缓存

`Cache-Control:Private`     内容只缓存到私有缓存中

`Cache-Control:no-cache`  所有内容都不会被缓存



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


