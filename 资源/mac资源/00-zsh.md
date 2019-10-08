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



## 设置别名

```
# 编辑配置文件
vim ~.zshrc
# 添加配置, 保存退出
alias zshconfig="mate ~/.zshrc"
# 使命令生效
source ~.zshrc
```



