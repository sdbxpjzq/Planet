1、Synchronized  内置的Java关键字，  Lock 是一个Java类

2、Synchronized  无法判断获取锁的状态，Lock  可以判断是否获取到了锁
3、Synchronized  会自动释放锁，lock 必须要手动释放锁！如果不释放锁，死锁

4、Synchronized  线程 1（获得锁，阻塞）、线程2（等待，傻傻的等）；Lock锁就不一定会等待下 去；
5、Synchronized   可重入锁，不可以中断的，非公平；Lock ，可重入锁，可以 判断锁，非公平（可以 自己设置）；
6、Synchronized   适合锁少量的代码同步问题，Lock  适合锁大量的同步代码！ 





