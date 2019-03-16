<?php

function siftup(&$seq, $n) {
	$i = $n;
	while($i > 1) {
		$p = floor($i / 2);
		if($seq[$p] <= $seq[$i]) {
			break;
		}
		list($seq[$p], $seq[$i]) = array($seq[$i], $seq[$p]);
 
		$i = $p;
	}
}
 
/**
 * 向下筛选元素
 */
function siftdown(&$seq, $n) {
	$i = 1;
 
	while(1) {
		$c = $i * 2;
 
		if($c > $n) {
			break;
		}
 
		/* $c 为左结点 $c + 1 为右结点*/
		if($c + 1 <= $n) {
			if($seq[$c + 1] < $seq[$c]) {
				$c++;
			}
		}
 
		if($seq[$i] <= $seq[$c]) {
			break;
		}
 
		/* 将$seq[$i]和它的两个孩子结点中关键字较大者进行交换 */
		list($seq[$c], $seq[$i]) = array($seq[$i], $seq[$c]);
 
		$i = $c;
	}
}
 
 
 
/**
 * 堆排序
 * @param	array	$seq	待排序的序列
 */
function heapSort(&$seq) {
	$n = count($seq);
 
	for($i = 2; $i <= $n; $i++) {
		siftup($seq, $i);
	}
 
	for($i = $n; $i >= 2; $i--) {
		list($seq[1], $seq[$i]) = array($seq[$i], $seq[1]);
		siftdown($seq, $i - 1);
	}
}
 
/* 测试 */
$seq = array(1 => 9, 7, 2, 3, 1, 6);
heapSort($seq);
print_r($seq);
?>