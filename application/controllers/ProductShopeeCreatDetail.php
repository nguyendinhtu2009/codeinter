<?php
/**
* 
*/
class ProductShopeeCreatDetail extends CI_Controller
{
	
	public function index(){
		$this->load->model('ProductShopeeCreatModel');
		$this->ProductShopeeCreatModel->Shopee_To_Excel_Creat();
	}
}