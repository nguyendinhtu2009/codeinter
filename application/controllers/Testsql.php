<?php

/**
* 
*/
class Testsql extends CI_Controller
{
	
	public function index(){
		$this->db->where('seller_id', 'VN1XRBRL');
		$this->db->from('account');
		$new = $this->db->get();
		$num = $new->num_rows();
		$new = $new->result();
		echo $num;
		var_dump($new);

	}
}
		
