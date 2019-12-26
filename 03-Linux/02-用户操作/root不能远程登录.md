```
su root
vim /etc/ssh/sshd_config

// 修改一下内容
PermitRootLogin yes
PasswordAuthentication no  改为PasswordAuthentication yes
PubkeyAuthentication yes修改为no
AuthorizedKeysFile .ssh/authorized_keys前面加上#屏蔽掉


service sshd restart
```

这样，就能用root直接ssh登录了

