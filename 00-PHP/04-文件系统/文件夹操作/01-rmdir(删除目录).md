## rmdir

> `rmdir`只能删除空目录

现在有文件目录`./a/b`.

```php
$dir = './a';
echo rmdir($dir); // Warning: rmdir(./a): Directory not empty 
```

## 删除多层级目录

```php
$dir = './a';
rmRmDir($dir);
function rmRmDir($dir)
{
    $handle = opendir($dir);
    while ($fileName = readdir($handle)) {
        if ($fileName == '.' || $fileName =='..') {
            continue;
        }
        $fullPath = $dir . '/'. $fileName;
        if (is_dir($fullPath)) {
            rmRmDir($fullPath); // 递归
        } else {
            unlink($fullPath);
        }
    }
    rmdir($dir);
    closedir($handle);
}

```

