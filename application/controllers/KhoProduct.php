<?php
class KhoProduct extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
	}
	public function khoHang(){
		$this->load->model('KhoProductModel');
		$data['info']=$this->KhoProductModel->listKhoProduct();
		$this->load->view('header');
		$this->load->view('khoproduct',$data);
		$this->load->view('footer');
	}
}
