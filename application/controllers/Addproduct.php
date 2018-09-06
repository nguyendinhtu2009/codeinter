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
// Tạo tài khoản - img ---------------------------------
	public function add(){
		$this->load->model('AddproductModel');
		$data['info']=$this->AddproductModel->listAddProduct();
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

			if ($_FILES['files']['name']) {
				$filesCount = count($_FILES['files']['name']);
				for($i = 0; $i < $filesCount; $i++){
					$_FILES['file']['name']     = $_FILES['files']['name'][$i];
					$_FILES['file']['type']     = $_FILES['files']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$_FILES['file']['error']     = $_FILES['files']['error'][$i];
					$_FILES['file']['size']     = $_FILES['files']['size'][$i];

					$config['upload_path'] = './uploads/uploads_product';
					$config['allowed_types'] = 'gif|jpg|png';
					$this->load->library("upload", $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('file')) {
						$fileData = $this->upload->data();
						$data_insert['product_img'] = $data_insert['product_img'].",".$fileData['file_name'];
					}
				}
			}
				$this->AddproductModel->insertProduct($data_insert);
				echo "<script>alert('Tạo Sản Phẩm Thành Công');</script>";
				redirect(base_url()."addproduct/listproduct");
		}

		$this->load->view('header');
		$this->load->view('add_product',$data);
		$this->load->view('footer');
	}
// List danh sách *-------------------------------------------
	public function listproduct(){
		$this->load->helper("url");
		$this->load->model('AddproductModel');
		$data['info']=$this->AddproductModel->listAddProduct();
		$this->load->view('header');
		$this->load->view('list_product',$data);
		$this->load->view('footer');
	}
// Xóa Sản Phẩm *-----------------------------------------------
	public function del($id){
		$this->load->model('AddproductModel');
		$this->AddproductModel->delProduct($id);
		redirect(base_url()."addproduct/listproduct");
	}
// Sửa Sản Phẩm *-----------------------------------------------
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
				if ($_FILES['files']['name']) {
					$filesCount = count($_FILES['files']['name']);
					for($i = 0; $i < $filesCount; $i++){
						$_FILES['file']['name']     = $_FILES['files']['name'][$i];
						$_FILES['file']['type']     = $_FILES['files']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
						$_FILES['file']['error']     = $_FILES['files']['error'][$i];
						$_FILES['file']['size']     = $_FILES['files']['size'][$i];

						$config['upload_path'] = './uploads/uploads_product';
						$config['allowed_types'] = 'gif|jpg|png';
						$this->load->library("upload", $config);
						$this->upload->initialize($config);

						if ($this->upload->do_upload('file')) {
							$fileData = $this->upload->data();
							$data_update['product_img'] = $data_update['product_img'].",".$fileData['file_name'];
						}
					}
				}
				//$this->load->model('AddproductModel');
				$this->AddproductModel->editProduct($data_update,$id);
				redirect(base_url() . "addproduct/listproduct");
		}
		$this->load->view('header');
		$this->load->view('editProduct',$data);
		$this->load->view('footer');
	}

}























