<?php
class User extends AdminController
{
	public function __construct()
	{
		parent::__construct();
		@session_start();
	}

	public function index()
	{
		$this->_data['title'] = "Tạo Sản Phẩm";
		$this->_data['loadPage'] = "product/add_product";
		$this->load->view($this->_data['patch'], $this->_data);
	}
	public function add(){

	}

}
