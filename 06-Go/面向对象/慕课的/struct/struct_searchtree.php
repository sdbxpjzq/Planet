<?php
class node{
	public $value;
	public $left;
	public $right;
	public $parent;

	public function __construct($data){
		$this->value = $data;
	}
}

class searchtree{
	public $root = null;
	public $size = 0;
	public $depth = 0;

	public function __construct($value){
		$this->root = new node($value);
		$this->size++;
		$this->depth++;
	}

	public function addnode($array){
		foreach ($array as $key=> $value) {
			$current = $this->root;
			$parent = null;
			$currentdepth = 1;

			while($current !== null){
				$parent = $current;
				if($current->value == $value){
					continue 2;
				}
				elseif($current->value > $value){
					$current = $current->left;
				}else{
					$current = $current->right;
				}
				$currentdepth++;
			}

			$node = new node($value);
			$node->parent = $parent;
			if($parent->value > $value){
				$parent->left = $node;
			}else{
				$parent->right = $node;
			}
			if($this->depth < $currentdepth){
				$this->depth++;
			}
			$this->size++;
		}
		
		return true;
	}

	public function successor($node){
		if ($node->right !== null) {
			$current = $node->right;
			while($current->left !== null){
				$current = $current->left;
			}
        	return $current;
	    }
	    $parent = $node->parent;
	    while ($parent !== null && $node = $parent->right) {
	        $node = $parent;
	        $parent = $parent->parent;
	    }
    	return $parent;
	}

	public function delnode($value) {
		$node = $this->search($value);
		if ($node->left === null || $node->right === null) { 
			#如果待删除结点无子节点或只有一个子节点，则c = dnode
		    $current = $node;
		} else { 
			#如果待删除结点有两个子节点，current置为node的直接后继，以待最后将待删除结点的值换为其后继的值
		    $current = $this->successor($node);
		}

		//print_r($current->value);exit;

		if ($current->left !== null) {
		    $s = $current->left;
		} else {
		    $s = $current->right;
		}

		if ($s !== null) { #将current的子节点的父母结点置为current的父母结点，此处current只可能有1个子节点，因为如果c有两个子节点，则current不可能是node的直接后继
		    $s->parent = $current->parent;
		}

		if ($current->parent === null) { #如果current的父母为空，说明current=dnode是根节点，删除根节点后直接将根节点置为根节点的子节点，此处node是根节点，且拥有两个子节点，则current是node的后继结点，current的父母就不会为空，就不会进入这个if
		    $this->root = $s;
		} else if ($current == $current->parent->left) { #如果current是其父节点的左右子节点，则将current父母的左右子节点置为c的左右子节点
		    $current->parent->left = $s;
		} else {
		    $current->parent->right = $s;
		}

		#如果current!=node，说明current是node的后继结点，交换current和node的key值
		if ($current != $node) {
		    $node->value = $current->value;
		}
		#返回成功
		return true;
	}

	public function search($value){
		$current = $this->root;
		while($current !== null){
			if($current->value == $value){
				return $current;
			}
			elseif($current->value > $value){
				$current = $current->left;
			}else{
				$current = $current->right;
			}
		}
		return false;
	}

}


$tree = new searchtree(300);
$tree->addnode(array(124,360,250,110,260,270,160,350,370,320,352));
$tree->delnode(300);
print_r($tree);

?>