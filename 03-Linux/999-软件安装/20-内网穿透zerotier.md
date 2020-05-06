https://www.zerotier.com/download/



https://notice.pig4cloud.com/ecs.html



https://mdnice.com/

Zerotier 定义了几个专业名词：

- PLANET 行星服务器，Zerotier 根服务器
- MOON 卫星服务器，用户自建的私有根服务器，起到代理加速的作用
- LEAF 网络客户端，就是每台连接到网络节点。

## 初始化 CentOS7

```
curl -O http://pigx.vip/os7init.sh 

sh os7init.sh pig4cloud
```

## 本地和云服务器都需要安装客户端

```
curl -s https://install.zerotier.com | sudo bash
```

- 其他操作系统

下载地址： https://www.zerotier.com/download/

## 注册 `zerotier` 服务

https://my.zerotier.com/

```
zerotier-cli join ID

zerotier-cli leave ID
// 修改了IP要重离开, 重新加一下
```

## 部署MOON 卫星

### 配置 moon 服务

```
cd /var/lib/zerotier-one/

zerotier-idtool initmoon identity.public > moon.json

vim moon.json [具体看配置文件]

# 创建签名
zerotier-idtool genmoon moon.json

# 此ID 非常重要对应 唯一服务ID （在 zerotier 后台也能看到）
grep id /var/lib/zerotier-one/moon.json | head -n 1
```



配置文件

```
{
 "id": "2dec0d845c",
 "objtype": "world",
 "roots": [
  {
   "identity": "2dec0d845c:0:c9e5c7793e87f0ccfe02afed16d5d035db1945241b0b79a8e5ca1948c7acc3054e4fb1e63b65557f26fb180b98ddef79aedcf47dc1d64aa3cd1dc07162d2da43",
   "stableEndpoints": ["公网IPIP/9993"] // 公网IP/9993, 端口号是固定的
  }
 ],
 "signingKey": "c317f379055e6d2e57f1fd94d9b70be9f0543c2293c01e518ab066cdcf57f252aad802fe530f5900643ef69e83829350dd938eceb568c9666e3e0ddb6420c113",
 "signingKey_SECRET": "04d6a25be0aa0d77236c62778bdfc66e17870a4ea5a00d3753f634f0b15b34bbb10a14afd11b78f7dbd19547d79636f303863150342926eeed38e5aaee8a8f8d",
 "updatesMustBeSignedBy": "c317f379055e6d2e57f1fd94d9b70be9f0543c2293c01e518ab066cdcf57f252aad802fe530f5900643ef69e83829350dd938eceb568c9666e3e0ddb6420c113",
 "worldType": "moon"
}
```

开放阿里云端口

![](https://youpaiyun.zongqilive.cn/image/20200504144101.png)



### 将 moon 节点加入网络

在公网机子

```
mkdir /var/lib/zerotier-one/moons.d

cp 0000002dec0d845c moons.d/

systemctl restart zerotier-one(好像有问题, 这一步最好是重启系统)
```

![](https://youpaiyun.zongqilive.cn/image/20200504144854.png)

### 将内网机器连接上 moon 节点

不同系统下的 ZeroTier 目录位置：

- Windows: `C:\ProgramData\ZeroTier\One`
- Macintosh: `/Library/Application Support/ZeroTier/One` (在 Terminal 中应为 `/Library/Application\ Support/ZeroTier/One`)
- Linux: `/var/lib/zerotier-one`
- FreeBSD/OpenBSD: `/var/db/zerotier-one`



mac演示:

```
cd /Library/Application\ Support/ZeroTier/One/
sudo mkdir moons.d/
# 将在公网机子上的文件拷贝
cp 0000002dec0d845c moons.d/

# 要写2次 ID
zerotier-cli orbit dec0d845c dec0d845c 
zerotier-cli listpeers
```















