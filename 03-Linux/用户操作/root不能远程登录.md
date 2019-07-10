```
su root
vim /etc/ssh/sshd_config

// 修改一下内容
PermitRootLogin yes
PasswordAuthentication no  改为PasswordAuthentication yes

service sshd restart
```

这样，就能用root直接ssh登录了

