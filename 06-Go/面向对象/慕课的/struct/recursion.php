<?php
// $n=1000;
// countn($n);
// echo $value/$n;

// function countn ($n){
// 	global $value;
// 	if($n>0){
// 		$value = $value + $n;
// 		countn($n-1);
// 	}
// }



//兔子问题
/*一般而言，兔子在出生两个月后，就有繁殖能力，
一对兔子每个月能生出一对小兔子来。
如果所有兔都不死，那么一年以后可以繁殖多少对兔子？*/
$month = 12;
$lastmonth = 0;
$i=1;
$count =1;
rabbit();
echo $count;
function rabbit(){
	global $month,$count,$lastmonth,$i;
	if($i<=$month){
		//每个月的兔子是上个月的兔子+这个月新出生的兔子
		//而这个月新出生的兔子就是上个月能产仔的兔子数
		//上个月能产仔的兔子 就是上个月的总兔子数 - 上个月刚出生的兔子
		$current = $count - $lastmonth;
		$lastmonth = $current;
		$count = $count + $current;
		$i++;
		rabbit();
	}
}

?>