```php

$a1 = ['1','2','3','4','4'];
$a2 = ['a','b', 'c', 'd', 'e'];
array_multisort($a1,SORT_DESC,$a2, SORT_DESC);
var_dump('<pre>',$a1, $a2);

// [4,4,3,2,1], [e,d,c,b,a]

```

解释:

1. 第一个参数一定是一个数组，也是主排序的数组，也就是说当有多个要排序的数组时（每个数组元素个数必须一样），大家的数据怎么变，都是跟着第一个数组的顺序。这里的一条记录，就是纵向看，$a1中的1在第几位，$a2中的a就在第几位，他们属于一条记录，看下图：

![](https://ae01.alicdn.com/kf/H140ccd9621fd41068fcb32e017d827dd3.jpg)

2. 首先第一个参数$a1是一个数组，第二参数SORT_DESC，说明要对其进行倒序排序。$a1变为了[4,4,3,2,1]，那么$a2也是相对于$a1变化的，也即是说“整个5条记录是根据$a1的顺序排序的”， 最终得到的完整结果如下：

![](https://ae01.alicdn.com/kf/H5ab0a9121e954f46b30bfe6af1300d5fB.jpg)

3. 第三个参数a2是一个数组，第四个参数SORT_DESC，说明当“整个5条记录”根据a1数组排序完以后，如果**有重复的值**(比如4，4)，那么“整个记录的重复的部分要根据​a2进行倒序排序”。变为如下结果：

![](https://ae01.alicdn.com/kf/Ha73b903350194933814814068b36642fU.jpg)

下边的例子也就能分析了

```php

$arr1 = array(10, 100, 100, 0);
$arr2 = array(1,   3,   2,   4);
array_multisort($arr1, $arr2);
print_r($arr1);
print_r($arr2);
/*
Array
(
    [0] => 0
    [1] => 10
    [2] => 100
    [3] => 100
)
Array
(
    [0] => 4
    [1] => 1
    [2] => 2
    [3] => 3
)

*/

```



## 多维数组的指定两个字段排序

```php
$arr = array(
  '0' => array(
    'id' => 3,
    'age' => 27
  ),
  '1' => array(
    'id' => 5,
    'age' => 50
  )，
  '2' => array(
    'id' => 4,
    'age' => 44
  ),
  '3' => array(
    'id' => 3,
    'age' => 78
  ) 
);
foreach ( $arr as $key => $row ){
  $id[$key] = $row ['id'];
  $age[$key] = $row ['age'];
}
array_multisort($id, SORT_ASC, $age, SORT_DESC, $arr);
print_r($arr);

```



