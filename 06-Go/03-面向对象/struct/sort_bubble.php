<?php

$list = array(39, 38, 22, 45, 23, 67, 31, 15, 41,99);
$count = count($list);
$num = 0;

bubble($num);
//$newlist = bubblesort($list);
print_r($list);

//用循环实现冒泡排序
function bubblesort($numbers){
	$cnt=count($numbers);
	for($i=0;$i<$cnt-1;$i++){//循环比较
		for($j=$i+1;$j<$cnt;$j++){
			if($numbers[$j]<$numbers[$i]){//执行交换
				$temp=$numbers[$i];
				$numbers[$i]=$numbers[$j];
				$numbers[$j]=$temp;
			}
		}
	}
return$numbers;
}

//用递归实现冒泡排序
function bubble($num){
	global $list,$count;
	if($num < $count){
		for ($i=0; $i < $count-$num-1 ; $i++) { 
			if($list[$i] > $list[$i+1] ){
				$tem = $list[$i];
				$list[$i] = $list[$i+1];
				$list[$i+1] = $tem;
			}	
		}
		$num++;
		bubble($num);
	}
	
}


?>