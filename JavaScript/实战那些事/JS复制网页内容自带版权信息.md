```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>test</title>
</head>
<body>
<div id="copy">复制测试数据<b>test</b></div>
<script>
    function setClipboardText(event){
        event.preventDefault();//阻止元素发生默认的行为（例如，当点击提交按钮时阻止对表单的提交）。
        var node = document.createElement('div');
        node.appendChild(window.getSelection().getRangeAt(0).cloneContents());
        //getRangeAt(0)返回对基于零的数字索引与传递参数匹配的选择对象中的范围的引用。对于连续选择，参数应为零。
        var htmlData = '<div>著作权归作者所有。<br />'
            + '商业转载请联系作者获得授权，非商业转载请注明出处。<br />'
            + '作者：zongqi<br />链接：http://xxx/zongqi<br />'
            + '来源：zongqi<br /><br />'
            + node.innerHTML
            + '</div>';
        var textData = '著作权归作者所有。\n'
            + '商业转载请联系作者获得授权，非商业转载请注明出处。\n'
            + '作者：zongqi\n链接：http://xxxx/zongqi\n'
            + '来源：zongqi\n\n'
            + window.getSelection().getRangeAt(0);
        if(event.clipboardData){
            event.clipboardData.setData("text/html", htmlData);
            //setData(剪贴板格式, 数据) 给剪贴板赋予指定格式的数据。返回 true 表示操作成功。
            event.clipboardData.setData("text/plain",textData);
        }
        else if(window.clipboardData){ //window.clipboardData的作用是在页面上将需要的东西复制到剪贴板上，提供了对于预定义的剪贴板格式的访问，以便在编辑操作中使用。
            return window.clipboardData.setData("text", textData);
        }
    };
    var copy = document.getElementById("copy");
    copy.addEventListener('copy',function(e){
        setClipboardText(e);
    });
</script>
</body>
</html>



```

