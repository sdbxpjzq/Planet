```
location / {
	# 防止丢掉客户端真正IP地址
	proxy_set_header X-Forwarded-For $remote_addr;
	proxy_pass http://127.0.0.1:8080
}

```

