```php
function exportToExcel($filename, $tileArray=[], $dataArray=[]){
    ini_set('memory_limit','512M');
    ini_set('max_execution_time',0);
    ob_end_clean();
    ob_start();
    header("Content-Type: text/csv");
    header("Content-Disposition:filename=".$filename);
    $fp=fopen('php://output','w');
    fwrite($fp, chr(0xEF).chr(0xBB).chr(0xBF));//转码 防止乱码(比如微信昵称(乱七八糟的))
    fputcsv($fp,$tileArray);
    $index = 0;
    foreach ($dataArray as $item) {
        if($index==1000){
            $index=0;
            ob_flush();
            flush();
        }
        $index++;
        fputcsv($fp,$item);
    }

    ob_flush();
    flush();
    ob_end_clean();
}

```

使用

```php

\Ko_Web_Route::VGet("index", function () {
    $tileArray = [
        '姓名','电话'
    ];
    $data = [
        [
            'zongqi',
            12345
        ],
        [
            'zoxxx',
            126666
        ]
    ];
    exportToExcel('zongq.csv',$tileArray,$data);

});




```

```html

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<a id="down" href="https://xxxx/index">下载</a>
<script>
</script>
</body>
</html>
```