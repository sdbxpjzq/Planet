## XSS(Cross-Site Scripting)攻击
XSS (Cross-Site Scripting)，跨站脚本攻击，因为缩写和 CSS重叠，所以只能叫 XSS。

跨站脚本攻击是指通过存在安全漏洞的Web网站注册用户的浏览器内运行**非法的HTML标签或JavaScript**进行的一种攻击。

跨站脚本攻击有可能造成以下影响:

- 利用虚假输入表单骗取用户个人信息。
- 利用脚本窃取用户的Cookie值，被害者在不知情的情况下，帮助攻击者发送恶意请求。
- 显示伪造的文章或图片。

**XSS 的原理是恶意攻击者往 Web 页面里插入恶意可执行网页脚本代码，当用户浏览该页之时，嵌入其中 Web 里面的脚本代码会被执行，从而可以达到攻击者盗取用户信息或其他侵犯用户安全隐私的目的**。

### 非持久型 XSS（反射型 XSS ）

非持久型 XSS 漏洞，一般是通过给别人发送**带有恶意脚本代码参数的 URL**，当 URL 地址被打开时，特有的恶意代码参数被 HTML 解析、执行。

```html
<select>
     <script>
         document.write(''
             + '<option value=1>'
             +     location.href.substring(location.href.indexOf('default=') + 8)
             + '</option>'
         );
         document.write('<option value=2>English</option>');
     </script>
</select>
```

攻击者可直接通过URL (类似：`https://xxx.com/xxx?default=<script>alert(document.cookie)</script>`) 注入可执行的脚本代码。不过一些浏览器如Chrome其内置了一些XSS过滤器，可以防止大部分反射型XSS攻击。



非持久型 XSS 漏洞攻击有以下几点特征：

- 即时性，不经过服务器存储，直接通过 HTTP 的 GET 和 POST 请求就能完成一次攻击，拿到用户隐私数据。
- 攻击者需要诱骗点击,必须要通过用户点击链接才能发起
- 反馈率低，所以较难发现和响应修复
- 盗取用户敏感保密信息

为了防止出现非持久型 XSS 漏洞，需要确保这么几件事情：

- Web 页面渲染的所有内容或者渲染的数据都必须来自于服务端。
- 尽量不要从 `URL`，`document.referrer`，`document.forms` 等这种 DOM API 中获取数据直接渲染。
- 尽量不要使用`eval`, `new Function()`，`document.write()`，`document.writeln()``，``window.setInterval()`，`window.setTimeout()`，`innerHTML`，`document.createElement()` 等可执行字符串的方法。
- 如果做不到以上几点，也必须对涉及 DOM 渲染的方法传入的字符串参数做 escape 转义。
- 前端渲染的时候对任何的字段都需要做 escape 转义编码。

### 持久型 XSS（存储型 XSS）

持久型 XSS 漏洞，一般存在于 Form 表单提交等交互功能，如文章留言，提交文本信息等，黑客利用的 XSS 漏洞，将内容经正常功能提交进入数据库持久保存，当前端页面获得后端从数据库中读出的注入代码时，恰好将其渲染执行。

举个例子，对于评论功能来说，就得防范持久型 XSS 攻击，因为我可以在评论中输入以下内容:

![](https://youpaiyun.zongqilive.cn/image/006tKfTcgy1g09gsd6smij30p0088dg5.jpg)

主要注入页面方式和非持久型 XSS 漏洞类似，只不过持久型的不是来源于 URL，referer，forms 等，而是来源于**后端从数据库中读出来的数据** 。持久型 XSS 攻击不需要诱骗点击，黑客只需要在提交表单的地方完成注入即可，但是这种 XSS 攻击的成本相对还是很高。

攻击成功需要同时满足以下几个条件：

- POST 请求提交表单后端没做转义直接入库。
- 后端从数据库中取出数据没做转义直接输出给前端。
- 前端拿到后端数据没做转义直接渲染成 DOM。

持久型 XSS 有以下几个特点：

- 持久性，植入在数据库中
- 盗取用户敏感私密信息
- 危害面广



#### 如何防御

CSP 本质上就是建立白名单，开发者明确告诉浏览器哪些外部资源可以加载和执行。我们只需要配置规则，如何拦截是由浏览器自己实现的。我们可以通过这种方式来尽量减少 XSS 攻击。

通常可以通过两种方式来开启 CSP：

- 设置 HTTP Header 中的 Content-Security-Policy
- 设置 meta 标签的方式

这里以设置 HTTP Header 来举例：

- 只允许加载本站资源

  `Content-Security-Policy: default-src 'self'`


- 只允许加载 HTTPS 协议图片

`Content-Security-Policy: img-src https://*`

- 允许加载任何来源框架

`Content-Security-Policy: child-src 'none'`

#### 转义字符

用户的输入永远不可信任的，最普遍的做法就是转义输入输出的内容，对于引号、尖括号、斜杠进行转义

#### HttpOnly Cookie

这是预防XSS攻击窃取用户cookie最有效的防御手段。Web应用程序在设置cookie时，将其属性设为HttpOnly，就可以避免该网页的cookie被客户端恶意JavaScript窃取，保护用户cookie信息。



