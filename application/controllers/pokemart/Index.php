<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{	
		$this->load->model('PokeMart/Pokemart_model');
		$arProductType =  $this->Pokemart_model->GetProductType();
		$data =  array('arProductType' => $arProductType);
		$this->load->view('pokemart/template/main',$data,FALSE);
	}
}

/* End of file Index.php */
/* Location: ./application/controllers/Index.php */
