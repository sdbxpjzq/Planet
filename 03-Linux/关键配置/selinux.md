默认是开启,  要把它关闭掉.

查看状态`sestatus`

```
[root@localhost vagrant]# sestatus
SELinux status:                 enabled
SELinuxfs mount:                /sys/fs/selinux
SELinux root directory:         /etc/selinux
Loaded policy name:             targeted
Current mode:                   enforcing
Mode from config file:          enforcing
Policy MLS status:              enabled
Policy deny_unknown status:     allowed
Max kernel policy version:      31
```

**临时关闭**

`setenforce 0`

永久关闭

可以修改配置文件`/etc/selinux/config`,将其中`SELINUX`设置为`disabled`

