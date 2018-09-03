<?php
class AdminController extends MX_Controller{
	protected $_data;
	public function __construct()
	{
		parent::__construct();
		$this->load->library("session");
		$mod=$this->uri->segment(1);
		$this->_data['module']=$mod;
		$this->_data['patch']="$mod/template";

	}
}
?>
