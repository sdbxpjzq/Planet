安装pcntl扩展，使用pcntl_fork生成子进程异步执行任务

```PHP
if (($pid = pcntl_fork()) == 0) {
    child_func();    //子进程函数，主进程运行
} else {
    father_func();   //主进程函数
}
 
echo "Process " . getmypid() . " get to the end.\n";
 
function father_func() {
    echo "Father pid is " . getmypid() . "\n";
}
 
function child_func() {
    sleep(6);
    echo "Child process exit pid is " . getmypid() . "\n";
    exit(0);
}

```

