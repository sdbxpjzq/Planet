# 深拷贝 和 浅拷贝
  js中`值类型`的赋值为`深拷贝`，而`引用类型`的赋值为`浅拷贝`

# 浅拷贝:

就是把数据的地址赋值给对应变量，而没有把具体的数据复制给变量，变量会随数据值的变化而变化。

```js
		let a = { name: 'zon',  copy:  { ba: 200 } , a: null, b:undefined};
        let c = a;
        c.name = 'you';
        console.log(a);
```

```js

function simpleClone(initalObj) {
    var obj = {};
    for ( var i in initalObj) {
        obj[i] = initalObj[i];
    }
    return obj;


```

### Object.assigin
- 如果对象只有一层, 是深拷贝
- 对象多层, 是浅拷贝
```js
		
        let a = { name: 'zon',  copy:  { ba: 200 } , a: null, b:undefined};
        let b = { age: 100 };
        let obj = Object.assign({}, a,b);
        obj.name = 'qi';
        obj.copy.ba = 'qi';
        // console.log(a)
```

# 深拷贝:

就是把数据赋值给对应的变量，从而产生一个与源数据不相干的新数据(数据地址已变化)。

### 递归实现深拷贝
```js
	function deepCopy(object) {
            let target = {};
            for (let k in object) {
                if ((typeof object[k]) === 'object') {
                    target[k] = {};
                    arguments.callee(target[k]);
                } else {
                    target[k] = object[k];
                }
            }
            return target;
        }
		
		
		
         let a = { name: 'zon',  copy:  { ba: 200 } , a: null, b:undefined};
        let obj1 = copy(a);
        obj1.copy.ba ='hah';
        console.log(a);
        console.log(obj1);

```

###  JSON.stringify()  + JSON.parse()
 利用这种方式也可以实现深拷贝,  但是要注意 有些类型是不能 进行`stringify` 处理的, 如`undefined`, `function`, `RegExp对象`
```js
let a = { name: 'zon', copy: { ba: 200 }, a: null, b: undefined, fun: function(){alert(11)}};

        let aStr = JSON.stringify(a);

        let aCopy = JSON.parse(aStr);
        aCopy.copy.ba = 1;
        // aCopy.fun = 1;
        console.log(a);
        console.log(aCopy);
```

### Object.create()  深拷贝

```js
	function deepClone(initalObj) {
            var obj = {};
            for (var i in initalObj) {
                var prop = initalObj[i];
                
                if ((typeof prop) === 'object') {
                    obj[i] = Object.create(prop);
                } else {
                    obj[i] = prop;
                }
            }
            return obj;
        }
		
		
		
	 let a = { name: 'zon', copy: { ba: 200 }, a: null, b: undefined, fun: function () { alert(11) }, exp: /\d+/ };
	let obj = deepClone(a);
        obj.copy.ba = 11;
        console.log(obj);
        console.log(a);

```

### 一维数组深拷贝  slice()