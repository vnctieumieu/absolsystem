<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OrderManage_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
	}
	public function GetAllOrder()
	{
		return $this->db->query("SELECT orderbyuser.id, orderbyuser.userName, account.address, orderbyuser.dateTime, orderbyuser.status FROM orderbyuser, account WHERE orderbyuser.userName = account.userName")->result_array();
	}

}

/* End of file OrderManage_model.php */
/* Location: ./application/models/OrderManage_model.php */