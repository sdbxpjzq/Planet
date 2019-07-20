## 类选择排序法

​       为什么叫类选择排序法呢？因为这种方法很像选择排序，选择排序是抽出序列中的最大或最小值放在一端，这里也类似.

算法思路：对目标序列N个数遍历，取出其中最大的数最为Top1；再次遍历剩下的N-1个数，取出其中最大的数为Top2；....再对剩下的N-K+1个数遍历，取出其中最大的数为TopK，这样就可以找到最大的K个数了。

```java
vector<int> TopKBySelect(vector<int>& nums,int k,int len)
{
    vector<int>res;
 
    vector<int>flag(len);
 
    for(int i=0;i<k;i++)
    {
        int maxIndex=0;   //保存最大数的索引
        int maxNum=nums[0];  //保存最大数
 
        for(int j=0;j<len;j++)
        {
            if(nums[j]>maxNum&&!flag[j])  //如果大于最大数并且没有被取出来过
            {
                maxNum=nums[j];
                maxIndex=j;
 
            }
        }
        flag[maxIndex]=-1;    //将此次遍历的最大数索引标记为-1，放置再次被取出
        res.push_back(maxNum);  //存入该最大数
    }
 
    return res;
}
```

时间复杂度方面，要求TopK就需要进行K次遍历，然后取出其中最大的数，因此算法平均时间复杂度为O(N*K);

 空间复杂度方面，可以看到这种方法需要开辟一个辅助空间来对取出过的元素进行标记，因此空间复杂度为O(N)，除此之外，还需注意到的是，这种方法有效的前提是提前将所有数读入，这样如果一开始的N较大，那么空间开销是不可忽视的，而且，如果数据是动态的，即是可能会不停的增加新数据，那么就还需要每插入一个新数据就将其与前面取出的TopK做比较，排除K+1个数中最小的，最后剩下的才是TopK。



## 快速排序法

在快速排序中，每一轮排序都会将序列一分为二，左子区间的数都小于基准数，右子区间的数都大于基准数，而快速排序用来解决TopK问题，也是基于此的。N个数经过一轮快速排序后，如果基准数的位置被换到了i，那么区间[0,N-1]就被分为了[0,i-1]和[i+1,N-1]，这也就是说，此时有N-1-i个数比基准数大，i个数比基准数小，假设N-1-i=X那么就会有以下几种情况：

①X=K。这种情况说明比基准数大的有K个，其他的都比基准数小，那么就说明这K个比基准数大的数就是TopK了；

②X<K。这种情况说明比基准数大的数不到K个，但是这X肯定是属于TopK中的TopX，而剩下的K-X就在[0,i]之间，此时就应当在[0,i]中找到Top(K-X)，这就转换为了TopK的子问题，可以选择用递归解决；

③X>K。这种情况说明比基准数大的数超过了K个，那么就说明TopK必定位于[i+1,N-1]中，此时就应当继续在[i+1,N-1]找TopK，这样又成了TopK的一个子问题，也可以选择用递归解决。

```java
int getIndex(vector<int>& nums,int left,int right)  //快排获取相遇点（基准数被交换后的位置）
{
    int base=nums[left];
    int start=left;
    while(left<right)
    {
        while(left<right&&nums[right]>=base)right--;
        while(left<right&&nums[left]<=base)left++;
 
        int temp=nums[right];
        nums[right]=nums[left];
        nums[left]=temp;
    }
 
    nums[start]=nums[left];
    nums[left]=base;
 
    return left;
}
int findTopKthIndex(vector<int>&nums,int k,int left,int right)
{
    int index=getIndex(nums,left,right);    //获取基准数位置
 
    int NumOverBase=right-index;  //比基准数大的数的个数
 
    if(NumOverBase==k)return index;  //比基准数大的刚好有K个
 
    //比基准数大的多于K个，就在右边子区间寻找TopK
    else if(NumOverBase>k)return findTopKthIndex(nums,k,index+1,right);
 
    //比基准数大的少于K个，就在左边找剩下的
    return findTopKthIndex(nums,k-NumOverBase,left,index);
 
}
vector<int> TopKInQuick(vector<int>& nums,int k,int len)
{
    if(len==k)return nums;
 
    vector<int>res;
    vector<int>temp(nums.begin(),nums.end());  //TopK不对原数组改变
 
    int index=findTopKthIndex(temp,k,0,len-1);  //通过快排找到第K+1大的数的位置
 
    for(int i=len-1;i>index;i--)res.push_back(temp[i]);  //取出TopK返回
 
    return res;
}
```

这种方法是利用了快速排序中找分割点的方法，每次分割后的数组大小近似为原数组大小的一半，因此这种方法的时间复杂度实际上是O(N)+O(N/2)+O(N/4)+……＜O(2N)，因此时间复杂度为O(N)，时间复杂度虽然低，但是这种方法也需要提前将N个数读入，空间开销是一笔负担，并且对于动态的数据放入也是比较“死板”的。

## 堆排序法

 堆排序是通过维护大顶堆或者小顶堆来实现的。

可以用大小为K的最小堆实现：首先建立起一个大小为N的最小堆；然后从K+1个元素开始直到最后一个元素，插入一个元素，紧接着弹出堆顶元素（最小的那个），最后剩下的堆中元素即为n个元素中最大的K个。

```java

int pq[MAX];
int N=0;

void PQsort(int a[],int l,int r) {
    int k;
    for (k=l;k<l+N;k++) //建立大小为N的堆
        insert(a[k]);
    for(k=l+N;k<r;k++) { //每插入一个新元素，删去顶上元素
        insert(a[k]);
        deleteMax();
    }
    for(int i=1;i<=N;i++) //输出这个堆，即topN的解
        cout<<pq[i];
}
```

根据堆排序的复杂度，不难得出，在该方法中，首先需要对K个元素进行建堆，时间复杂度为O(K);然后对剩下的N-K个数对堆顶进行比较及更新，最好情况下当然是都不需要调整了，那么时间复杂度就只是遍历这N-K个数的O(N-K)，这样总体的时间复杂度就是O(N)，而在最坏情况下，N-K个数都需要更新堆顶，每次调整堆的时间复杂度为logK，因此此时时间复杂度就是NlogK了，总的时间复杂度就是O(K)+O(NlogK)≈O(NlogK)。空间复杂度是O(1)。值得注意的是，堆排序法提前只需读入K个数据即可，可以实现来一个数据更新一次，能够很好的实现数据动态读入并找出TopK。





















































