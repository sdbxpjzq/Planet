## open() 方法和send() 方法

`async` 默认是`true`

### `GET`请求

```js
xmlhttp.open("GET","test1.php",false); 

xmlhttp.send();
```

### `POST`请求

```js
xmlhttp.open("POST","ajax_test.asp",true);

xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

xmlhttp.send("fname=Bill&lname=Gates");//提交的内容
```

## XMLHttpRequest 对象的三个重要的属性

### `onreadystatechange`

​	存储函数（或函数名），每当 `readyState` 属性改变时，就会调用该函数。    

### `readyState`

存有 XMLHttpRequest 的状态。从 0 到 4 发生变化。

·0: 请求未初始化

·1: 服务器连接已建立

·2: 请求已接收

·3: 请求处理中

·4: 请求已完成，且响应已就绪

```js
xhr.onreadystatechange=function()
  {
  if (xhr.readyState==4 && xmlhttp.status==200) //就绪
    {	document.getElementById("myDiv").innerHTML=xhr.responseText;
    }
  }
```

### `status`

200: "OK"

404: 未找到页面



## 响应的内容形式

### responseText

### responseXML



## 中断请求

### abort

`xhr.abort()`

## 兼容代码

```js
function ajaxFunction()
 {
 var xmlHttp;
 try
    {
   // Firefox, Opera 8.0+, Safari
    xmlHttp=new XMLHttpRequest();
    }
 catch (e)
    {
  // Internet Explorer
   try
      {
      xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
      }
   catch (e)
      {
      try
         {
         xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
         }
      catch (e)
         {
         alert("您的浏览器不支持AJAX！");
         return false;
         }
      }
    }
return xmlHttp;
}
```



