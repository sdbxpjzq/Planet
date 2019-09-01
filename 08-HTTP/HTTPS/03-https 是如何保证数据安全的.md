有必要引入第三方，一个权威的证书颁发机构（CA）来解决.

到底什么是证书呢？证书包含如下信息：

![](https://ws2.sinaimg.cn/large/006tKfTcly1g0dsifms1sj30bf07vq31.jpg)

为了便于说明，我们这里做了简化，只列出了一些关键信息。至于这些证书信息的用处，我们看看具体的通信流程就能够弄明白了.

流程如下：

1. 作为服务端的小红，首先把自己的**公钥**发给证书颁发机构，向证书颁发机构申请证书。

![](https://ws1.sinaimg.cn/large/006tKfTcly1g0dsjc2hf1j30h20b2aa5.jpg)

2. 证书颁发机构自己也有一对公钥私钥。机构利用自己的私钥来加密Key1，并且通过服务端网址等信息生成一个证书签名，证书签名同样经过机构的私钥加密。证书制作完成后，机构把证书发送给了服务端小红。

![](https://ws1.sinaimg.cn/large/006tKfTcly1g0dskleqkhj30h20b2t8s.jpg)

3. 当小灰向小红请求通信的时候，小红不再直接返回自己的公钥，而是把自己申请的证书返回给小灰。

![](https://ws1.sinaimg.cn/large/006tKfTcly1g0dsljud2aj30h20byaa7.jpg)

4. 小灰收到证书以后，要做的第一件事情是验证证书的真伪。需要说明的是，**各大浏览器和操作系统已经维护了所有权威证书机构的名称和公钥**。所以小灰只需要知道是哪个机构颁布的证书，就可以从本地找到对应的机构公钥，解密出证书签名。

接下来，小灰按照同样的签名规则，自己也生成一个证书签名，**如果两个签名一致，说明证书是有效的。**

验证成功后，小灰就可以放心地再次利用机构公钥，解密出服务端小红的公钥Key1。

![](https://ws2.sinaimg.cn/large/006tKfTcly1g0dsmzpcilj30h20b2jri.jpg)

5. 小灰生成自己的对称加密密钥Key2，并且用服务端公钥Key1加密Key2，发送给小红。

![](https://ws4.sinaimg.cn/large/006tKfTcly1g0dsnp5b65j30h20b2wel.jpg)

6. 最后，小红用自己的私钥解开加密，得到对称加密密钥Key2。于是两人开始用Key2进行对称加密的通信。

![](https://ws2.sinaimg.cn/large/006tKfTcly1g0dspkrwdkj30m20bkmxf.jpg)





上面的一系列认证流程是在`SSL`层当中完成的,

![](https://ws4.sinaimg.cn/large/006tKfTcly1g0dss7qk1zj307o0bgdft.jpg)







