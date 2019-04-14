<?php
//顺序查找

$data = array(14,6,7,8,4,55,67,45,118,37,84);

var_dump(search(45));

function search($num){
	global $data;
	$position = false;
	for ($i=0,$count=count($data); $i < $count; $i++) { 
		if($data[$i] == $num){
			$position = $i;
			break;
		}
	}
	return $position;
}



?>