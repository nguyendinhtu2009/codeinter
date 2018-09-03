<?php
class AddproductModel extends CI_Model{
	protected $_table="product";
	public function __contruct(){
		parent::__construct();
	}
	public function insertProduct($data){
		$query=$this->db->insert($this->_table,$data);
	}
	public function listAddProduct(){
		510634937781185
	}
}
