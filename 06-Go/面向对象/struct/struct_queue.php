<?php 

//用数组实现队列
/*$queuelist = array();

for ($i=0; $i < 10; $i++) { 
	array_push($queuelist, $i); //将数据添加到数组末尾(排队排到最后)
}

for ($i=0,$count = count($queuelist); $i <$count ; $i++) { 
	$value = array_shift($queuelist); //将数据从数组头部拿出去(排队在最前面的先处理了);
}*/


//如果我们自己实现入队列,出队列怎么处理


	  
//节点信息	   
                            
class node {

	public $value;   //节点的数据

	public function __construct($value) {
		$this->value = $value;
	}
}

/*	 
队列的实现
队列存储方式?
队列过期时间?
队列锁定时间?
队列最大数量
队列头值
队列尾值
队列值
*/	                                                             
class queue{
	
	public	$head;  //指向头元素
	public	$last;  //指向尾部元素
	public  $list; 	//队列的数据 ,如果换成文件,或者memcache来存储,回事什么样
	private	$size=0;//队列节点个数

	//出队列
	function dequeue ( ){
 		if(!$this->size){
 			return null;
 			exit('error! the queue is empty!');
 		}
 		$current = $this->head;
 		$i=0;
 		foreach ($this->list as $key => $value) {
 			if($i < 2){
 				$remove[] = $key;
 			}
 			$i++;
 		}
 		unset($this->list[$remove[0]]);
 		$this->head = @$this->list[$remove[1]];
 		$this->size--;
 		return $current;
	}

	//进队列
	function enqueue ( $value ){
		$node=new Node($value);
	 	$this->list[] = $node;
	 	if($this->size == 0){
			$this->head = $node;
		}
		$this->last = $node;
	 	$this->size++; //增加队列的长度
	 	
	}
	
	function size(){
		return $this->size;
	}


	public function lock(){

	}

	public function unlock(){

	}

}

//以下开始是demo展示


$queue = new queue();
for ($j=0;$j<10; $j++){
	$queue ->enqueue($j);
}

//print_r($queue);
//echo $queue ->dequeue() ,"\n--";
while(null !==($val=$queue ->dequeue() ) ){
	var_dump($val);
}


 

 