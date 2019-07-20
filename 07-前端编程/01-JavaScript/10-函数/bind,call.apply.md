#  call()、apply()、bind() 都是用来重定义 this 这个对象的
`bind`是返回一个新的函数，所以需要额外调用()一次
```js
let name = '小王';
        let obj = {
            name: '小丽',
            show: function () {
                console.log(this.name);
            }
        }

        let db = {
            name: '小祥'
        }

        obj.show.call(db);　　　　// 小祥
        obj.show.apply(db);　　　 //  小祥       
        obj.show.bind(db)();　　　// 小祥  // 是返回一个新的函数，所以需要额外调用()一次
```

#  对比call 、bind 、 apply 传参情况下

```js
let name = '小王';
        let obj = {
            name: '小丽',
            show: function (a, b) {
                console.log(a +'去往'+ b);
            }
        }

        let db = {
            name: '小祥'
        }

        obj.show.call(db, '成都', '上海');　　　　 // 成都去往上海
        obj.show.apply(db, ['成都', '上海']);      // 成都去往上海  
        obj.show.bind(db, '成都', '上海')();       // 成都去往上海

```