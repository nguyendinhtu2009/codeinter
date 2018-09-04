<?php
class KhoProductModel extends CI_Model
{
	protected $_table = "product";

	public function __contruct()
	{
		parent::__construct();
	}

	public function listKhoProduct(){
		$this->db->select("id,product_skv,product_name,product_msp,product_mt,product_date,product_img");
		$this->db->order_by("id","desc");
		return $this->db->get($this->_table)->result_array();
	}
}
