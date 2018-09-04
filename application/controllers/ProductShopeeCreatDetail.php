<?php
/**
* 
*/
class ProductShopeeCreatDetail extends CI_Controller
{
	public function __contruct(){
		parent::__construct();
		$this->load->model('ProductShopeeCreatModel');
	}


	public function index(){
		$this->load->view('header');
		if(isset($_FILES["file"]["name"]))
		  {
		  	echo 1;
			$data['data'] = $this->ProductShopeeCreatModel->Shopee_Import_Product($_FILES["file"]["tmp_name"], $this->input->post('seller_id'));
			$this->load->view('ShopeeProductView', $data);

		  }else{
		  	$data['data'] = '';
		  	$this->load->view('ShopeeProductView', $data);
		  } 
		$this->load->view('footer');
	}

	public function creat(){
		$this->ProductShopeeCreatModel->Shopee_To_Excel_Creat();
	}

	public function LoadUpdate($sellerid){
		$this->load->model('ProductShopeeCreatModel');
		$this->ProductShopeeCreatModel->Shopee_Update_Product($sellerid);

	}

}