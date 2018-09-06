<?php
class AddproductModel extends CI_Model{
	protected $_table="product";
	public function __contruct(){
		parent::__construct();
	}
	public function insertProduct($data){
		$this->db->insert($this->_table,$data);
	}
	public function listAddProduct(){
		$this->db->select("id,product_skv,product_name,product_msp,product_mt,product_date,product_img,product_te,product_vn,product_pricelz,product_chenh");
		$this->db->order_by("id","desc");
		$this->db->limit(10);
		return $this->db->get($this->_table)->result_array();
	}
	public function delProduct($id){
		$this->db->where("id",$id);
		$this->db->delete($this->_table);
	}
	public function getByIdProduct($id){
		$this->db->where("id",$id);
		return $this->db->get($this->_table)->row_array();
	}
	public function editProduct($data,$id){
		$this->db->where("id",$id);
		$this->db->update($this->_table,$data);
	}
}
