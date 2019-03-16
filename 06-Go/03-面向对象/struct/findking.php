<?php

//单个节点
class node {
	//初始化变量,包括存储的内容 和 下一个数据的指针
	public $id = 0;
	public $data = '';
	public $next = null;

	//构造函数,设置存储内容的数据
	public function __construct($id,$nodedata){
		$this->id = $id;
		$this->data = $nodedata;
	}
}


class singleLink {
	public $head = '';
	public $size = 0;

	public function insert($id,$value,$prenodeid = 0){
		$node = new node($id,$value);
		//空链表,直接添加
		if ($this->size == 0){
			$this->head = $node;
		} elseif ($prenodeid == 0) {
			//如果不是空链表,且并没有指定在某一个节点前添加
			//则在当前节点前添加
			$node->next = $this->head;
			$this->head = $node;
		} else {
			//在某一节点后添加新节点
			$cruntnode = $this->head;
			while($cruntnode->next != null ){
				if($cruntnode->next->id == $prenodeid){
					$node->next = $cruntnode->next;
					$cruntnode->next = $node;
					break;
				}
				$cruntnode = $cruntnode->next;
			}
		}
		$this->size++;
		return $this;
	}

	public function edit($id,$value){
		$flag = false;
		$current = $this->head;
		while(@$current->id !=null){
			if($current->id == $id){
				$current->data = $value;
				$flag = true; 
				break;
			} 
			$current = $current->next;
		}
		return $flag;
	}

	public function getnode($id=0){
		$current = $this->head;
		$i=1;
		while($i <= $this->size){
			if($i == $id){
				$node = $current;
				break;
			} 
			$current = $current->next;
			$i++;
		}
		return $node;
	}

	public function sort(){
		
	}

	public function delete($id){
		$flag = false;
		$current = $this->head;
		while(@$current->id !=null){
			if($current->next->id == $id){
				$current->next = $current->next->next;
				$this->size--;
				$flag = true; 
				break;
			} 
			$current = $current->next;
		}
		return $flag;
	}


	function makecircle(){
		$lastnode=$this->getnode($this->size); //获取最后一个节点
		//var_dump($lastnode);exit;
		$lastnode->next=$this->head;  //变为循环单链表
	}

	public function findking($m){
		$current=$this->head;
		$num = 1 ; 
		while( $current->next != $current ){
			if( $num == $m-1 ){
				$current->next = $current->next->next; //舍弃了第m个节点
				$current = $current->next ;   //往后移动一位
				$num = 1;	//重置m为 1
				continue;
			}
			$current=$current->next;
			$num++ ;
		}
		echo " \$m=$m ,大王就是: ", $current->data;
	}
}

$linklist = new singleLink();
$linklist->insert(1,'hello');
$linklist->insert(2,'my');
$linklist->insert(3,'love');
$linklist->insert(4,'haha4');
$linklist->insert(5,'haha5');
$linklist->insert(6,'haha6');
$linklist->insert(7,'haha7');
$linklist->insert(8,'haha8')->insert(9,'haha9')->insert(10,'haha10')->insert(11,'haha11');

$linklist->makecircle();
$linklist->findking(4);

?>