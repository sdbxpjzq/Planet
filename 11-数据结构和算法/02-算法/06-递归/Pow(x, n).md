leetcode 50



例如 n = 13，则 n 的二进制表示为 1101, 那么 m 的 13 次方可以拆解为:

m^1101 = m^0001 * m^0100 * m^1000。

我们可以通过 & 1和 >>1 来逐位读取 1101，为1时将该位代表的乘数累乘到最终结果。直接看代码吧，反而容易理解：

时间复杂度近为 O(logn)，

```c
int pow(int n){
    int sum = 1;
    int tmp = m;
    while(n != 0){
        if(n & 1 == 1){
            sum *= tmp;
        }
        tmp *= tmp;
        n = n >> 1;
    }

    return sum;
}
```

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1g3zpzdf4r3j30zq0fegpt.jpg)

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1g3zq0fs8tqj31cg0q4q9f.jpg)



非递归写法

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1g3zq3d6fzej30q20tsn0w.jpg)

