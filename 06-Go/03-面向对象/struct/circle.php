<?php
/*$n = 100;
$count = 0;
for ($i=0; $i <= $n; $i++) { 
	$count = $count + $i;
}

echo $count;*/


$count = rabbit(12);
echo $count;

function rabbit($month){
	$count = 1;
	$lastmonthcount = 0;
	for ($i=1; $i <= $month; $i++) {
		$current = $count - $lastmonthcount;
		$lastmonthcount = $current;
		$count = $count + $current;
	}
	return $count;
}





?>