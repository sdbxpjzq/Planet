## htmlspecialchars

函数对于过滤用户输入的数据非常有用。它会将一些特殊字符如`&`、`"`、`'`、`<`、`>`转换为HTML实体。例如，用户输入`<` 时，就会被该函数转化为HTML实体 `&lt;`。（HTML实体对照表：[http://www.w3school.com.cn/html/html_entities.asp](http://www.w3school.com.cn/html/html_entities.asp)），可以防止XSS和SQL注入攻击。

注意，`htmlspecialchars()` 函数只是把认为有安全隐患的HTML字符进行转换，如果想要把HTML所有可以转义的字符都进行转义，请使用`htmlentities()`。

## htmlentities

功能同 `htmlspecialchars()`，不同的是，它可以转义所有的 HTML字符。

