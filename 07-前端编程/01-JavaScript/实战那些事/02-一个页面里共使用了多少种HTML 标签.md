```js

let doms = document.getElementsByTagName('*');
        console.log(toString.call(doms)) //[object HTMLCollection]
        let domsTagArr = [];
        Array.from(doms).forEach(function(v,k) {
            domsTagArr.push(((v.tagName.toLowerCase()))); // tagName 默认都是大写
        });

        console.log([...new Set(domsTagArr)])
```

