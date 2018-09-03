<?php
/**
* 
*/
class ProductLazDetail extends CI_Controller
{	
	public function index(){
		echo 'function not ready.';
	}

	public function PublicProduct(){
		$this->load->model('ProductLazModel');
		$data = $this->ProductLazModel->Public_Product_Laz('VN1XSN7I', '50000800924rb8r8HCq2pQZB7gvDlwEuOjcd1bc13a40ey9P0tFJDShzSuRo63', '105265', 'RGbHb5QrXkuMVVd5ry8PVzekHYXQJwD8');
		var_dump($data);
	}

	public function UpdateProductLaz(){
		$this->load->model('ProductLazModel');
		$data = $this->ProductLazModel->Update_Product_Laz('VN1XSN7I', '50000800924rb8r8HCq2pQZB7gvDlwEuOjcd1bc13a40ey9P0tFJDShzSuRo63', '105265', 'RGbHb5QrXkuMVVd5ry8PVzekHYXQJwD8');
		var_dump($data);
	}

	public function RemoveProductLaz(){
		$this->load->model('ProductLazModel');
		$data = $this->ProductLazModel->Update_Product_Laz('GDA0001', '50000800924rb8r8HCq2pQZB7gvDlwEuOjcd1bc13a40ey9P0tFJDShzSuRo63', '105265', 'RGbHb5QrXkuMVVd5ry8PVzekHYXQJwD8');
		var_dump($data);
	}

	public function GetProductLaz(){
		$this->load->model('ProductLazModel');
		$data = $this->ProductLazModel->Get_Product('2018-01-01T00:00:00+0800', '50000100818c6pes6knp2rTgA0ftco1c0f9e56SeVvdfFdU4MuTdmeKKidqYzi', '105265', 'RGbHb5QrXkuMVVd5ry8PVzekHYXQJwD8');
		var_dump($data);
	}

}