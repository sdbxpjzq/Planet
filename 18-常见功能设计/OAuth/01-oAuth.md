oauth授权流程

![](https://ae01.alicdn.com/kf/Hb6b915c1e5144a2cb3a001a68e5297dd2.png)

1. 用户使用微信登录自如APP

2. 自如APP向用户申请访问用户的个人微信资料

3. 用户点击同意（代表用户同意自如访问他的微信信息）

4. 用户点击同意时，自如会携带一个回调地址，去微信服务器申请获取code

5. 微信返回一个code给自如

6. 自如携带code和回调地址，再次想微信请求获取access_token

7. 微信将access_token返回给自如

8. 自如以后就会通过这个access_token，去访问用户的微信资料





1. code是有时效性的，尽量在获取后的几分钟内去申请获取access_token

2. access_token也是有过期时间的，而过期后就需要重新获取新的令牌