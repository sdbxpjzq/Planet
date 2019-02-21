```js
for (var index =0; index < 5 ;index++) {
    setTimeout(() => {
        console.log(index +'time'+new Date());
    }, index * 1000);
}

```
![](https://ws2.sinaimg.cn/large/006tNc79gy1fvmzz4ra7vj30cr03adfn.jpg)

# 总结
- `setTimeout`执行是同步的, 回调函数是异步的, 每隔一定的时间放入异步队列

# 解决办法

### 封装成一个函数
```js
function loop(i) {
    setTimeout(function timer() {
        console.log(i +'time'+new Date());
    }, i * 1000);
}

for (let index =0; index < 5 ;index++) {
    loop(index);
}
```

### bind
```js
for (let index =0; index < 5 ;index++) {
    setTimeout(function timer(i) {
        console.log(i +'time'+new Date());
    }.bind(null,index), index * 1000);
}
```

### 利用setTimeout参数传参
```js
for (var index = 0; index < 5 ;index++) {
    setTimeout((i) => {
        console.log(i +'time'+new Date());
    }, index * 1000, index);
}
```
### let
```js
for (let index =0; index < 5 ;index++) {
    setTimeout(() => {
        console.log(index +'time'+new Date());
    }, index * 1000);
}

```

### 闭包
```js
for (var index =0; index < 5 ;index++) {
    (function(i) {
        setTimeout(() => {
            console.log(i +'time'+new Date());
        }, i * 1000);
    })(index)
}
```

### await
```js
for (var index =0; index < 5 ;index++) {
    await new Promise((resolve, reject) => {
        setTimeout(() => {
            resolve(console.log(index +'time'+new Date()));
        }, index * 1000);
    });
}

```
![](https://ws1.sinaimg.cn/large/006tNc79gy1fvqaqjw2lgj30bi03cq2s.jpg)