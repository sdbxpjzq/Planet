<?php
$list = array(10,3,5,7,18,11,45,64,74,23,21,6);
$list = insertsort($list);
var_dump($list);

//插入排序
function insert_sort($array){
	$return = array();
	for ($i=0,$count=count($array); $i < $count; $i++) {
		$last = true;
		//用无序的值与有序的值循环对比,把这个无序的值插入到有序列表中去
		for ($j=0,$size=count($return); $j < $size; $j++) { 
			if($return[$j] > $array[$i]){
				$last= false;				
				$m = $size;
				while($m > $j){
					$return[$m] = $return[$m-1];
					$m--;
				}
				$return[$j] = $array[$i];
				break;
			}
		}
		if($last){
			$return[] = $array[$i];
		}
	}
	return $return;
}




function insertsort($arr){   
    $count = count($arr);
    for($i=1;$i<$count;$i++){   
        $tmp = $arr[$i];   
        $j = $i - 1;
        //让每次循环的元素与新数组的前一个循环比较做比较   
        while($j>=0 && $tmp<$arr[$j]){   
            $arr[$j+1] = $arr[$j];   
            $j--;   
        }   
        $arr[$j+1] = $tmp;   
    }   
       
    return $arr;
}   
?>