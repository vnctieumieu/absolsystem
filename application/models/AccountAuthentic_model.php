<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AccountAuthentic_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
	}
	public function InsertAccount($data)
	{
		$this->db->insert('account', $data);
		return $this->db->insert_id();
	}
	public function GetAccountByUserName($userName)
	{
		$this->db->select('*');
		$this->db->where('userName', $userName);
		return $this->db->get('account')->row_array();
	}
	public function UpdateAccount($user,$data)
	{
		$this->db->where('userName', $user);
		return $this->db->update('account', $data);
	}

}

/* End of file accountAuthentic_model.php */
/* Location: ./application/models/accountAuthentic_model.php */