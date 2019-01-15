## Selection对象

`window.getSelection()`返回一个Selection对象，表示用户选择的文本范围或光标的当前位置。

## Range对象

```js
window.getSelection().getRangeAt(0)
//getRangeAt方法有一个参数index，代表该Range对象的序列号；我们可以通过Selection对象的rangeCount参数的值判断用户是否选取了内容；
//getRangeAt(0)返回对基于零的数字索引与传递参数匹配的选择对象中的范围的引用。对于连续选择，参数应为零。

```

cloneContents

克隆选中Range的fragment并返回改fragment

```js
var node = document.createElement('div');
node.appendChild（window.getSelection().getRangeAt(0).cloneContents()）
//这样我们就简单的一行代码直接克隆了你鼠标所选择的内容
```









