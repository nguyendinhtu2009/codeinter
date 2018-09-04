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
		$this->form_validation->set_rules('nameproduct', 'nameproduct', 'required',
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
				echo "<script>alert('Đăng Sản Phẩm Thành Công');</script>";
				redirect(base_url()."addproduct/listproduct");
		}
		$this->load->view('header');
		$this->load->view('add_product');
		$this->load->view('footer');
	}
	public function listproduct(){
		$this->load->helper("url");
		$this->load->model('AddproductModel');
		$data['info']=$this->AddproductModel->listAddProduct();
		$this->load->view('header');
		$this->load->view('list_product',$data);
		$this->load->view('footer');
	}
	public function del($id){

		$this->load->model('AddproductModel');
		$this->AddproductModel->delProduct($id);
		redirect(base_url()."addproduct/listproduct");
	}
	public function edit($id)
	{
		$this->load->model('AddproductModel');
		$data['info']=$this->AddproductModel->getByIdProduct($id);
		if($this->input->post('ok')){
				$data_update = array(
					'product_skv' => $this->input->post('skv'),
					'product_name' => $this->input->post('nameproduct'),
					'product_msp' => $this->input->post('maproduct'),
					'product_mt' => $this->input->post('mtprodcut')
				);
				//$this->load->model('AddproductModel');
				$this->AddproductModel->editProduct($data_update,$id);
				redirect(base_url() . "addproduct/listproduct");
		}
		$this->load->view('header');
		$this->load->view('editProduct',$data);
		$this->load->view('footer');
	}

}























