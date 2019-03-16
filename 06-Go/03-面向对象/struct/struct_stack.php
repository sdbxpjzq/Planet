<?php 
//用数组来实现堆栈

/*$stacklist = array();
array_push($stacklist, "a");
array_push($stacklist, "b");
array_push($stacklist, "c");

$data = array_pop($stacklist);
var_dump($data);*/

/*	  
节点信息	   
*/	                            
class node {

	public $value;   //节点的数据
 
	function __construct($value) {
		$this->value = $value;
	}
	
}

/*	 
堆栈的实现
*/	                                                             
class stack{

	public	$last;  //指向尾部元素
	public  $stacklist; //堆栈元素列表
	private	$size=0; //队列节点个数

	//出栈
	function pop( ){
		if($this->size == 0){
			return null;
			exit('error! the stack is empty!');
		}
		$data = $this->last;
		array_pop($this->stacklist);
		$this->last = end ($this->stacklist);
		$this->size--;
		return $data;
	}

	//入栈
	function push ($value ){
		$node=new node($value);
		$this->last = $node;
		$this->stacklist[] = $node;
		$this->size++;	
	}
	
	//返回栈顶元素，但是不出栈
	function end(){
		//此处代码等你来完善
		
	}
	
	
	function size(){
		return $this->size;
	}

}
//以下开始是demo展示


$stack = new stack();
for ($j=0;$j<10; $j++){
	$stack ->push($j);
}


while( $node=$stack ->pop() ){
	echo $node->value, "\n";
}
	
 

 