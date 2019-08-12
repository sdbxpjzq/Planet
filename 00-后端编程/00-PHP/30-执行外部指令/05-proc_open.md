```php
resource proc_open ( string cmd, array descriptorspec, array &pipes [, string cwd [, array env [, array other_options]]] )
```

描述：与popen类似，但是可以提供双向管道。

```php

<?php
/**
 * @author: hedong
 * @date 2017-04-04
 */

// 管道配置
$descriptors = array(
    0 => array("pipe", "r"),
    1 => array("pipe", "w")
);

$process = proc_open("php", $descriptors, $pipes);

if (is_resource($process)) {
    fwrite($pipes[0], "<?php\n");
    fwrite($pipes[0], "  \$rand = rand(1,2);\n");
    fwrite($pipes[0], "  if (\$rand == 1) {\n");
    fwrite($pipes[0], "    echo \"Hello, World!\n\";\n");
    fwrite($pipes[0], "  } else {");
    fwrite($pipes[0], "    echo \"Goodbye, World!\n\";\n");
    fwrite($pipes[0], "  }");
    fwrite($pipes[0], "?>");
    fclose($pipes[0]);

    $output = "";
    while (!feof($pipes[1])) {
        $output .= fgets($pipes[1]);
    }

    $output = strtoupper($output);
    echo $output; fclose($pipes[1]);

    proc_close($process);
}

// 输出结果：

GOODBYE, WORLD!
```

注意：
① 后面需要使用proc_close()关闭资源，并且如果是pipe类型，需要用pclose()关闭句柄。
② proc_open打开的程序作为php的子进程，php退出后该子进程也会退出。