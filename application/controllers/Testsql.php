<?php

/**
* 
*/
class Testsql extends CI_Controller
{
	
	public function index(){
		$this->load->database();
		$data = $this->db->get('orderid');
		$data = $data->result();
			var_dump(json_decode($data[0]->sellersku, TRUE));

	}
}
		
