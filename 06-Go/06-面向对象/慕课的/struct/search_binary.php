<?php
$data = array(4,6,7,8,14,55,67,145,218,237,284);

$num = binarysearch(4);
var_dump($num);
function binarysearch($num){
	global $data;
	$count = count($data);
	$high = $count-1;
	$low = 0;
	
	while ($high >= $low){
		$mid  = floor(($high+$low)/2);
		if($num == $data[$mid]){
			return $mid;
		}elseif($num > $data[$mid]){
			$low = $mid + 1;
		}elseif($num < $data[$mid]){
			$high = $mid - 1;
		}
	}
	return false;
}

?>