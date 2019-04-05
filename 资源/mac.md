[TOC]

# sublime 插件

    https://jeffjade.com/2015/12/15/2015-04-17-toss-sublime-text/
    - SideBarEnhancements
    - DocBlockr
    - SyncedSideBar
    - AutoFileName
    - Bracket Highlighter

# Dr.Cleaner Mac下免费实用的清理软件

直接appstroe免费下载

https://itunes.apple.com/cn/app/id921458519?mt=12&at=1001ldFh&ct=pPpWY170823

# http-server 安装

安装

` npm install -g http-server `

运行

` http-server`

http://www.cnblogs.com/lucker/p/4108838.html

# git 命令补全设置

https://github.com/bobthecow/git-flow-completion/wiki/Install-Bash-git-completion



# 护颜色



- R: 199;          G:  237     B:204;
- R:  204           G: 232      B: 207

# mac内置键盘和触控板失灵的解决办法

下面是Apple给出的解决方案：

1. 重置电源
   1.1 插上电源
   1.2 按住左侧的 shift + control + option + 开关键；
   1.3 15秒后放手见到电源灯转绿色，表示重置完成。
2. 重置数据
   2.1 按开机键；
   2.2 开机亮屏前，同时按住 command + option + p + r；
   2.3 听到3~4声启动声后（系统会频繁重启，等到3~4次后），双手放开；
   2.4 等待系统自动开机；







# mac java环境

[jdk下载](http://www.oracle.com/technetwork/java/javase/downloads/)





# ngrok

ngrok



#  处理 .DS_Store 的方法

.DS_Store是Mac OS保存文件夹的自定义属性的隐藏文件，如文件的图标位置或背景色，相当于Windows的desktop.ini。

## 禁止生成

`defaults write com.apple.desktopservices DSDontWriteNetworkStores -bool TRUE`



## 恢复生成

`defaults delete com.apple.desktopservices DSDontWriteNetworkStores`

## 删除所有的 .DS_Store 文件

`sudo find / -name ".DS_Store" -depth -exec rm {} \;`



# 设置macOS 10.12 Sierra 安全性与隐私的设置中任何来源选项

`sudo spctl --master-disable`

# 远程连接机器

- SecureCRT

设置颜色去 session option

- Remote Desktop Manager   — 功能更多

可以设置成简体中文. 点击“Preference…”，选择“User Interface”，将“Language:”更改为“Chinese”后重启软件完成汉化



# Photoshop下载安装

http://tieba.baidu.com/p/4791130877



#  实时刷新

http://browsersync.cn/

1. `npm install -g browser-sync`
2. `browser-sync start --server --files "**/*.css, **/*.html"`

# 读写NTFS格式硬盘

- 免费推荐--http://enjoygineering.com/mounty/


`brew cask install mounty`

#  Homebrew(推荐安装)

- [Homebrew][https://brew.sh/]

# 图片自动上传图床

- iPic
- iPic move
- AIfred(需要破解版本) 设置快捷键
- https://github.com/chenxtdo/UPImageMacApp



# Mac免费的文件解压缩软件—keka

http://www.kekaosx.com/zh-cn/



# VIP视频解析网站

http://v.laod.cn/



#  翻墙推荐

http://blog.sina.com.cn/s/blog_170550d8a0102wzr2.html



## 红杏影梭

https://www.hxss.biz/



## 云末加速

http://www.ymjsq.org/

## FreeVPN Plus

去appstore下载就行. 

https://www.freevpn.pw/

win.mac都有

## 蓝灯

https://github.com/getlantern/forum



## 一枝红杏

99元/年, 50G/月, 同时支持1个在线

199元/年,无限流量,同事支持3个客户端在线

https://my.yizhihongxing.com/aff.php?aff=5961



## 修改`host`文件翻墙

提供2个常用地址(一直在更新中).
[老D博客](https://laod.cn/hosts)

[github上的](https://github.com/racaljk/hosts)

### `host`文件位置

hosts所在文件夹：

- Windows 系统
  - hosts位于 `C:\Windows\System32\drivers\etc\hosts`
- Android（安卓）系统
  - hosts位于 `/etc/hosts`
- Mac（苹果电脑）系统
  - hosts位于 `/etc/hosts`
  - 可以使用iHost工具
- iPhone（iOS）系统
  - hosts位于 `/etc/hosts`
- Linux系统
  - hosts位于 `/etc/hosts`
- 绝大多数Unix系统都是在 `/etc/hosts`

# Node 安装

- Windows或Mac系统，访问[https://nodejs.org/](https://nodejs.org/)，安装**LTS**版本的Node，默认安装即可





# cmake安装

- `brew install cmake`

# libcurl安装

- 1、先到[http://curl.haxx.se/](http://curl.haxx.se/%E4%B8%8A%E4%B8%8B%E8%BD%BD%E6%9C%80%E6%96%B0%E7%9A%84curl%E6%BA%90%E7%A0%81) 上下载最新的curl源码

  2、终端：进入解压后的curl目录

  3、终端：./configure --prefix=/usr/local/curl (设置安装路径)(省略也可以)

  4、终端：make (编译)

  5、终端：make install (安装)

# 代理工具--whistle

- whistle --跨平台[手册](https://avwo.github.io/whistle/)[教程](https://www.qcloud.com/community/article/151)--(目前只是使用了简单的代理,许多功能还没有用到) 
- 安装(或更新)— `sudo npm install -g whistle`
- 启动— `w2 start`


>  电脑也要安装证书的

https://mp.weixin.qq.com/s/Dehz2FhFriNBVseRlyAwzw

## 更新日志

https://github.com/avwo/whistle/blob/master/CHANGELOG.md

## weinre的使用

weinre可以用于调试远程页面特别是移动端的网页.

配置规则的时候,后面加上 `weinre id`

```js
 # xxx为对应的weinre id，主要用于页面分类，默认为anonymous
 www.example.com weinre://xxx  
```

栗子:

```js
m.mafengwo.cn/sales/activity/honey_center/ weinre://test  
```

在weinre下拉列表就可以找到设置的weinre id的，点击会新开一个weinre调试页面，可以开始使用weinre.

https://avwo.github.io/whistle/rules/weinre.html


#  终端 -Oh My Zsh

命令行工具[Oh My Zsh](https://github.com/robbyrussell/oh-my-zsh)---[教程][https://sanwen8.cn/p/1b9NhOn.html]

**安装**

`wget https://github.com/robbyrussell/oh-my-zsh/raw/master/tools/install.sh -O - | sh`

**切换**
`chsh -s /usr/local/bin/zsh`

  查看
`cat /etc/shells`
`
/bin/bash --mac默认
/bin/csh
/bin/ksh
/bin/sh
/bin/tcsh
/bin/zsh

**主题设置:**

1. 存储目录: `cd ~/.oh-my-zsh/themes`
2. 编辑主题配置文件: `vim ~/.zshrc`,可以找到`ZSH_THEME="robbyrussel"`,默认的主题.
3. 更改主题 `ZSH_THEME="random"`, 可以设置成随机的, 当看到好看的执行`echo $ZSH_THEME`查看就行.`apple.zsh-theme(正在用的)`,`dstufft.zsh-theme`,`jonathan.zsh-theme`,`rkj-repos.zsh-theme`感觉还不错.

**启用插件**

1. 存放目录: `~/.oh-my-zsh/plugins`
2. 编辑启用:`vim ~/.zshrc` ,`plugins=(git,sudo,zsh-syntax-highlighting)`,往里添加(,分隔)就行
3. 常见插件说明--http://www.cnblogs.com/mitnick/p/6270384.html — https://www.v2ex.com/t/156997




 # tmux

1. **安装**`brew install tmux`
2. 新建窗口— `tmux new -n <窗口名>`
3. 装了 oh-my-zsh 的话，自定义窗口名不起作用,修改zsh的配置文件,打开`DISABLE_AUTO_TITLE="true"`

# 文件同步

https://syncthing.net/



# 其他工具

- 微信开发者工具
- phpstorm
- webstorm
  - [破解网站-参考一](http://idea.lanyus.com/)
  - [破解网站-参考二](http://www.imsxm.com/jetbrains-license-server.html)
  - [破解网站]— http://xidea.online
- 为知笔记,有道笔记,印象笔记
- 滴答清单
- Spark(邮箱), 网易邮箱大师
- 微信,QQ
- FileZilla
- Dash
- Mou,MacDown,小书匠,Bear,Typora
- SourceTree
- Photoshop
- Mark Man
- Charles
- Paste
- iHost
- AIfred3—(有破解版)
- 射手影音
- Sequel Pro,Navicat Premium 
- Sublime Text
- Sketch
- Adobe Acrobat
- Parallels Desktop
- Postman
- [兼容性查询网站](http://caniuse.com/)




# 设计相关

https://www.mockplus.cn/





# Sublime汉化

http://www.sdifen.com/sublimetextlanguage.html





## 忽略 `node_module`文件

`File -> Setting -> Editor -> File types -> Ignore files and folders`

在`Ignore files and folders`最后加上`node_modules`;保存就可以了，然后重启WebStorm一切就将改变。




# SecureCRT快捷键

**编辑命令**

Ctrl + a ：移到命令行首
Ctrl + e ：移到命令行尾
Ctrl + xx：在命令行首和光标之间移动

Ctrl + u ：从光标处删除至命令行首
Ctrl + k ：从光标处删除至命令行尾
Ctrl + w ：从光标处删除至字首

command + 1/2/3... ： 在多个不同的session标签之间切换









# mac键盘图标

![](https://ws3.sinaimg.cn/large/006tKfTcly1fh7pwkb5ogj30ps0umwfc.jpg)







# 推荐下载地址

[史蒂芬周的博客](http://www.sdifenzhou.com/)

[打卡下载](http://digit77.com/en/macos)

https://www.waitsun.com/

http://xclient.info/

http://www.amegaz.com/

http://www.zhinin.com/