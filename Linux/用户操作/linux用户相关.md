## 创建用户

`useradd 用户名 -p 密码`

## 删除用户

`userdel 用户名` — 【此用户的相应文件还在】

`userdel  -r  用户名` — 【目录一起删】

若该账户只是暂时不用，可以更改`/etc/shadow`倒数第二个字段设置为`0`

## 修改用户名

`usermod -l  新用户名  旧用户名`

## 修改密码

`passwd 用户名`-----修改某个用户的密码

`passwd -d  用户名`—删除某个用户名的密码

`passwd -l  用户名`---锁定某个账号的密码

`passwd -U  用户名-`--解锁某个账号的密码



## 其他命令

- `whoami` # 查看当前用户



## 切换用户身份 — su

`su root`

`su zongqi`

## 普通用户添加sudo权限

root用户下，

1. 修改文件权限   `chmod u+w /etc/sudoers`


2. "vim /etc/sudoers",进入编辑模式，找到这一 行(91行)：

   `root ALL=(ALL)  ALL`

   在起下面添加"

   `xxx ALL=(ALL)  ALL`(这里的xxx是你的用户名)，然后保存退出。

​       3. 撤销文件的写权限。"chmod u-w /etc/sudoers"



普通用户执行: `sudo su -` 切换到`root`





## 用户组

- `groups  用户名`  or  `id  用户名` # 查看当前用户属于哪个组


- `cat /etc/group`  # 查看所有的组信息
- `usermod  -G  组名  用户名`# 将用户添加到某个组里



| Groupadd   组名          | 创建一个组 |
| ---------------------- | ----- |
| Groupmod  -n  新组名  旧组名 | 更改组名  |
| Groupdel   组名          | 删除一个组 |
|                        |       |

## 修改文件的拥有者

`chown yangzongde testfile` //修改文件拥有者为 yangzongde 

## 修改文件的所属用户组

`chgrp yangzongde testfile` //修改拥有者组为 yangzongde 

## 一次修改文件的拥有者和所属组

 `chown root:root testfile` // 使用 `chown` 一次性修改拥有者及组 