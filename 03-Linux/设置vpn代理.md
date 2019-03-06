## socks5 全局代理

### 安装 sslocal

```
pip install shadowsocks # pip安装ss客户端
如果提示 -bash: pip: command not found
运行 yum -y install python-pip
```

### shadowsocks.json

```
vim /etc/shadowsocks.json
--- shadowsocks.json ---
{
    "server":"SERVER-IP",   # 你的服务器ip
    "server_port":PORT,    # 服务器端口
    "local_address": "127.0.0.1",
    "local_port":1080,
    "password":"PASSWORD",    # 密码
    "timeout":300,
    "method":"aes-128-cfb", # 加密方式
    "fast_open": false,
    "workers": 1
}
--- shadowsocks.json ---
```

### 运行 sslocal

```shell
nohup sslocal -c /etc/shadowsocks.json &>> dev/null &
```

## privoxy篇

### 安装 privoxy

```
yum -y install privoxy
```

### 配置 socks5 全局代理

```
echo 'forward-socks5 / 127.0.0.1:1080 .' >> /etc/privoxy/config
```

### 设置 http/https 代理

```
export http_proxy=http://127.0.0.1:8118 # privoxy默认监听端口为8118
export https_proxy=http://127.0.0.1:8118
```

### 运行 privoxy

```
service privoxy start
```

### 测试 socks5 全局代理

```
curl www.google.com
## 如果出现下面这段输出则代理成功！
------------------------------------------------------------------------------
<HTML><HEAD><meta http-equiv="content-type" content="text/html;charset=utf-8">
<TITLE>302 Moved</TITLE></HEAD><BODY>
<H1>302 Moved</H1>
The document has moved
<A HREF="http://www.google.com.hk/url?sa=p&amp;hl=zh-CN&amp;pref=hkredirect&amp;pval=yes&amp;q=http://www.google.com.hk/%3Fgws_rd%3Dcr&amp;ust=1480320257875871&amp;usg=AFQjCNHg9F5zMg83aD2KKHHHf-yecq0nfQ">here</A>.
</BODY></HTML>
------------------------------------------------------------------------------
```

## 简化使用

进过上面的步骤我们的确代理成功了。。但是每次都要输入这么多命令太麻烦
这时我们可以利用 命令别名 来简化我们的操作

```
alias ssinit='nohup sslocal -c /etc/shadowsocks.json &>> /var/log/sslocal.log &'
alias sson='export http_proxy=http://127.0.0.1:8118 && export https_proxy=http://127.0.0.1:8118 && systemctl start privoxy'
alias ssoff='unset http_proxy && unset https_proxy && systemctl stop privoxy && pkill sslocal'
```

### 使用方法

```
### 开启ss代理
ssinit
sson
## 关闭ss代理
ssoff
```