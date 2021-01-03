## Crontab 定时任务

https://tool.lu/crontab/

```shell
crontab [-u username]　　　　//省略用户表表示操作当前用户的crontab
    -e      (编辑工作表)
    -l      (列出工作表里的命令)
    -r      (删除工作作)
```



们用**crontab -e**进入当前用户的工作表编辑，是常见的vim界面。每行是一条命令。

crontab的命令构成为 时间+动作，其时间有`分、时、日、月、周`五种，操作符有

- `*` 取值范围内的所有数字
- `/` 每过多少个数字
- `-` 从X到Z
- `，`散列数字





```shell
每1分钟执行一次myCommand
* * * * * myCommand

每小时的第3和第15分钟执行
3,15 * * * * myCommand

每1小时执行一次myCommand
* */1 * * * myCommand

在上午8点到11点的第3和第15分钟执行
3,15 8-11 * * * myCommand

每晚的21:30执行一次myCommand
30 21 * * * myCommand

晚上11点到早上7点之间，每隔一小时 执行一次myCommand
* 23-7/1 * * * myCommand
```



























