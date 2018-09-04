<?php
/**
* 
*/
class ProductShopeeCreatDetail extends CI_Controller
{
	public function index(){
		$this->load->view('header');
		if(isset($_FILES["file"]["name"]))
		  {
		  	echo 1;
			$this->load->model('ProductShopeeCreatModel');
			$data['data'] = $this->ProductShopeeCreatModel->Shopee_Import_Product($_FILES["file"]["tmp_name"], $this->input->post('seller_id'));
			$this->load->view('ShopeeProductView', $data);

		  }else{
		  	$data['data'] = '';
		  	$this->load->view('ShopeeProductView', $data);
		  } 
		$this->load->view('footer');
	}

	public function creat(){
		$this->load->model('ProductShopeeCreatModel');
		$this->ProductShopeeCreatModel->Shopee_To_Excel_Creat();
	}

	public function import(){
		$this->load->view('header');
		$this->load->view('ShopeeProductView');
		  if(isset($_FILES["file"]["name"]))
		  {
		  	echo 1;
			$this->load->model('ProductShopeeCreatModel');
			$data['data'] = $this->ProductShopeeCreatModel->Shopee_Import_Product($_FILES["file"]["name"]);
			$this->load->view('ShopeeProductView', $data);

		  } 
		 $this->load->view('footer');
	}
}