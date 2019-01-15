`ClipboardEvent.clipboardData `属性保存了一个` DataTransfer` 对象，这个对象可用于：

描述哪些数据可以由 `cut` 和` copy` 事件处理器放入剪切板，通常通过调用 `setData(format, data)` 方法；
获取由 `paste` 事件处理器拷贝进剪切板的数据，通常通过调用 `getData(format)` 方法

**三个方法**（ sDataFormat:"text","url","file","html","image"，sData: 剪贴数据）

- `clearData(sDataFormat)` 删除剪贴板中指定格式的数据。
- `getData(sDataFormat)` 从剪贴板获取指定格式的数据。 
- `setData(sDataFormat, sData)` 给剪贴板赋予指定格式的数据。
   返回 true 表示操作成功。



```js
event.clipboardData.setData("text/html", htmlData);
event.clipboardData.setData("text/plain",textData);
event.clipboardData.setData("text", textData);
```

