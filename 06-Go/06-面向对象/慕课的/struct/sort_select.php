<?php
$list = array(10,3,5,7,18,11,45,64,74,23,21,6);
$list = select_sort($list)
var_dump($list);
function select_sort($list){
	$count = count($list);
	for ($i=0; $i < $count; $i++) { 
		$k = $i;
		for ($j=$i+1; $j < $count; $j++) { 
			if($list[$k] > $list[$j]){
				$k = $j;
			}
		}
		if($k != $i){
			$tem = $list[$i];
			$list[$i] = $list[$k];
			$list[$k] = $tem;
		}
	}
	return $list;
}


?>