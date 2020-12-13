<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OrderManage extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
	}
	public function LoadOrderManageView()
	{
		$this->load->view('admin/PokemartManage/OrderManage/main_view');
	}
	public function LoadShowOrderManageItems()
	{	
		$this->load->model('/admin/pokemart/OrderManage/OrderManage_model');
		$data = $this->OrderManage_model->GetAllOrder();
		$data = array('data' => $data);
		$this->load->view('admin/PokemartManage/OrderManage/showOrderManage_view',$data,FALSE);
	}
}

/* End of file OrderManage.php */
/* Location: ./application/controllers/OrderManage.php */