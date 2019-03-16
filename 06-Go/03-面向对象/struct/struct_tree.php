<?php
class tree{
	public $key;
	public $left;
	public $right;

	public function __construct($key,$left = null,$right = null){
		$this->key = $key;
	}

	public function travers_pre_order(){
		$l = array();
		$r = array();
		if($this->left){
			$l = $this->left->travers_pre_order();
		} 
		if($this->right){
			$r = $this->right->travers_pre_order();
		} 

		return array_merge(array($this->key),$l,$r);
	}

	public function travers_in_order(){
		$l = array();
		$r = array();
		if($this->left){
			$l = $this->left->travers_in_order();
		} 
		if($this->right){
			$r = $this->right->travers_in_order();
		} 

		return array_merge($l,array($this->key),$r);
	}

	public function travers_post_order(){
		$l = array();
		$r = array();
		if($this->left){
			$l = $this->left->travers_post_order();
		} 
		if($this->right){
			$r = $this->right->travers_post_order();
		} 

		return array_merge($l,$r,array($this->key));
	}
}

$root = new tree('a');
$root->left = new tree('b');
$root->left->left = new tree('c');
$root->left->left->left = new tree('d');
$root->left->right = new tree('e');
$root->right = new tree('f');



var_dump($root->travers_pre_order());exit;






class node{
	public $key;
	public $left;
	public $right;

	public function __construct($key,$left = null,$right = null){
		$this->key = $key;
		$this->key = &$left;
		$this->key = &$right;
	}
}


?>