1、来自不同的类 

wait => Object
sleep => Thread

2、关于锁的释放 wait 会释放锁，sleep 睡觉了，抱着锁睡觉，不会释放！
3、使用的范围是不同：wait必须在同步代码块中，sleep可以在任何地方睡

