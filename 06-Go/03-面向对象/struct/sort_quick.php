<?php
$list = array(10,3,5,7,11,45,64,74,23,21,6);

$return = quicksort($list);
var_dump($return);exit;

//用递归的方式
function quicksort($arr){
	if(count($arr)>1){
		//把第一个元素取出来,用于比较,
		//比它大的放到某个数组,
		//比它小的放到另外一个数组
		$k=$arr[0];
		$x=array();
		$y=array();
		$size=count($arr);
		for($i=1;$i<$size;$i++){
			if($arr[$i]<=$k){
				$x[]=$arr[$i];
			}else{
				$y[]=$arr[$i];
			}
		}
		$x=quicksort($x);
		$y=quicksort($y);
		return array_merge($x,array($k),$y);
	}else{
		return$arr;
	}
}

?>