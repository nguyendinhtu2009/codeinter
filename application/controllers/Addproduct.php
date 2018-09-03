<?php
class Addproduct extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		@session_start();
	}

	public function index()
	{
		$this->load->view('header');
		$data['title'] = "Tạo Sản Phẩm";
		$this->load->view('footer');
	}
	public function add(){
		$this->load->model('AddproductModel');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('skv', 'skv', 'required');
		$this->form_validation->set_rules('nameproduct', 'Passnameproductword', 'required',
			array('required' => 'You must provide a %s.')
		);
		$this->form_validation->set_rules('maproduct', 'maproduct Confirmation', 'required');


		if ($this->form_validation->run() == TRUE)
		{
			$data_insert=array(
				"product_skv"=>$this->input->post('skv'),
				"product_name"=>$this->input->post('nameproduct'),
				"product_msp"=>$this->input->post('maproduct'),
				"product_mt"=>$this->input->post('mtprodcut')
			);
			$this->AddproductModel->insertProduct($data_insert);
		}else{
			echo "<script>alert('ban chua dien thong tin');</script>";
		}


		$this->load->view('header');
		$data['title'] = "Tạo Sản Phẩm";
		$this->load->view('add_product');
		$this->load->view('footer');
	}

}
