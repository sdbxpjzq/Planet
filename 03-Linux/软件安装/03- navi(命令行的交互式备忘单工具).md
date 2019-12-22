> 项目地址：https://github.com/denisidoro/navi

## navi 的目标

- 通过查看给定关键字或文字描述提高命令的可发现性；
- 如以长命令来作为辅助部分，将查找后的结果可直接复制粘贴到原始命令中；
- 与其他人可同时共享，以便他人不必知道如何编写命令；
- 支持命令行的自动补全功能，提高终端的使用性；

## 安装 navi

需要先安装 `fzf`

```shell
git clone --depth 1 https://github.com/junegunn/fzf.git ~/.fzf
~/.fzf/install
source ~/.bashrc
```

```shell
git clone --depth 1 http://github.com/denisidoro/navi /opt/navi
cd /opt/navi
sudo make install
install fzf: https://github.com/junegunn/fzf
```

## navi 的使用

安装完成后，直接在命令输入` navi`，进入到交互式备忘录界面。

![](https://pic3.superbed.cn/item/5dfda1e376085c3289a04117.jpg)





