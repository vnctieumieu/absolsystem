<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{	
		if ($this->session->userdata('account') && $this->session->userdata('account')['isAdmin'] == 1 ) {
			$this->load->view('/admin/template/main');
		}else {
			redirect('Index','refresh');
		}
	}
}

/* End of file Index.php */
/* Location: ./application/controllers/Index.php */