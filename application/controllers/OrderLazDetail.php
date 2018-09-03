<?php
/**
* 
*/
class OrderLazDetail extends CI_Controller
{
	
	public function index()
	{
		$this->load->model('OrderDetailModel');
		$data['data'] = $this->OrderDetailModel->getOrder_Laz();
		$this->load->view('header');
		$this->load->view('OrderDetailView', $data);
		$this->load->view('footer');
		
	}

}
?>