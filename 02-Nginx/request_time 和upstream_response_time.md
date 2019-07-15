## request_time

指的就是从接受用户请求的第一个字节到发送完响应数据的时间，即包括接收请求数据时间、程序响应时间、输出

request_time包含了用户数据接收时间



## upstream_response_time

真正程序的响应时间

指从Nginx向后端（php-cgi)建立连接开始到接受完数据然后关闭连接为止的时间。