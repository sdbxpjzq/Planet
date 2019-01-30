## 不同之处

`include()`在执行文件时每次都要进行读取和评估；

`require()`，文件只处理一次（实际上，文本内容替换了require()语句）



## 使用场景

如果可能执行多次的代码，则使用`require()`效率较高；

如果执行代码时是读取不同的文件，或者有通过一组文件迭代的循环，则使用 `include()`



```php
require 'config.php';

if($condition)
    include 'file.text';
else
    include 'other.php';

require 'somefile.php';

```

文件的开头和结尾处使用`require()`语句，在这个脚本执行前，就会读入它所引入的文件，使它包含的文件成为当前php脚本的一部分；



`include()`语句放在流程控制的处理区段中使用，当php脚本文件在读到它时，才将它包含的文件读进来。

## 错误处理方面

`require` 会生成致命错误（`E_COMPILE_ERROR`）并停止脚本

`include` 只生成警告（`E_WARNING`），并且脚本会继续



## include_once()和require_once()

如果该文件中的代码已经被包含，则不会再次包括。

这两个语句应用在脚本执行期间，同一个文件有可能被包括超过一次的情况下，确保只被包括一次，避免函数重定义以及变量重新赋值。





