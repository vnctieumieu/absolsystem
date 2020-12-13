<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function GetHomePageVideo() {
		$this->db->select('*');
		return $this->db->get('homepagevideo')->row_array();
	}
	public function GetHomePagePoster() {
		$this->db->select('*');
		return $this->db->get('homepageposter')->result_array();
	}
	public function UpDataHomePagePoster($id,$data) {
		if ($this->session->userdata('account') && $this->session->userdata('account')['isAdmin'] == 1) {
			$this->db->where('id', $id);
			return $this->db->update('homepageposter', $data);
		}
	}
	public function UpDataHomePageVideo($id,$data) {
		if ($this->session->userdata('account') && $this->session->userdata('account')['isAdmin'] == 1) {
			$this->db->where('id', $id);
			return $this->db->update('homepagevideo', $data);
		}
	}
	public function LoadHistoryOrder($user) {
		return $this->db->query("SELECT orderbyuser.id, orderbyuser.status, orderbyuser.dateTime, orderbyuser.amoutProduct FROM orderbyuser WHERE orderbyuser.userName = '$user'")->result_array();
	}
	public function LoadDetaiOrderByID($id) {
		return $this->db->query("SELECT product.name, product.price, orderdetail.amount FROM product, orderdetail, orderbyuser WHERE product.id = orderdetail.productID and orderbyuser.id = orderdetail.orderByUserID and orderbyuser.id = '$id'")->result_array();
	}
	public function UpdateAddress($user,$data)
	{
		$this->db->where('userName', $user);
		return $this->db->update('account', $data);
	}
}

/* End of file index_model.php */
/* Location: ./application/models/index_model.php */