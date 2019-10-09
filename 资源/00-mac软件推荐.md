[TOC]

# 处理 .DS_Store 的方法

.DS_Store是Mac OS保存文件夹的自定义属性的隐藏文件，如文件的图标位置或背景色，相当于Windows的desktop.ini。

## 禁止生成

`defaults write com.apple.desktopservices DSDontWriteNetworkStores -bool TRUE`



## 恢复生成

`defaults delete com.apple.desktopservices DSDontWriteNetworkStores`

## 删除所有的 .DS_Store 文件

`sudo find / -name ".DS_Store" -depth -exec rm {} \;`



# 代理工具--whistle

- whistle --跨平台[手册](https://avwo.github.io/whistle/)[教程](https://www.qcloud.com/community/article/151)--(目前只是使用了简单的代理,许多功能还没有用到) 
- 安装(或更新)— `sudo npm install -g whistle`
- 启动— `w2 start`

> 电脑也要安装证书的

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



# 读写NTFS格式硬盘

- 免费推荐--http://enjoygineering.com/mounty/

`brew cask install mounty`

# Homebrew

https://brew.sh/

# 清理软件





# Finder管理

## TotalFinder

## XtraFinder



# 窗口管理

## TotalSpaces2





# zsh

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

设置别名

```
# 编辑配置文件
vim ~.zshrc
# 添加配置, 保存退出
alias zshconfig="mate ~/.zshrc"
# 使命令生效
source ~.zshrc
```