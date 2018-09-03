<?php
/**
* 
*/
class ProductLazDetail extends CI_Controller
{	
	public function index(){
		$this->load->model('Product_Laz');
		$data = $this->Product_Laz->Get_Product('2018-01-01T00:00:00+0800', '50000100818c6pes6knp2rTgA0ftco1c0f9e56SeVvdfFdU4MuTdmeKKidqYzi', '105265', 'RGbHb5QrXkuMVVd5ry8PVzekHYXQJwD8');
		var_dump($data);
	}
}