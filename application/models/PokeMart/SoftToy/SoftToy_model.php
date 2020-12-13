<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SoftToy_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
	}
	public function GetProductByIdType($idtype)
	{
		return $this->db->query("SELECT product.id, product.name, product.price, product.itemsLove, product.size FROM product join producttype ON producttype.id = product.typeCode WHERE producttype.id = $idtype and product.status = 1")->result_array();
	}
	public function GetProduct() {
		return $this->db->query("SELECT product.id, product.name, product.price, product.itemsLove, product.size FROM product join producttype ON producttype.id = product.typeCode WHERE producttype.status = 1 and product.status = 1")->result_array();
	}
	public function GetAvatarProduct($idProduct) {
		return $this->db->query("SELECT pictureproduct.picture FROM product, pictureproduct WHERE product.id = pictureproduct.idProduct and product.id = $idProduct LIMIT 1")->row_array();
	}
	public function GetProductPictureByID($id) {
		return $this->db->query("SELECT pictureproduct.picture FROM product join pictureproduct ON product.id = pictureproduct.idProduct WHERE product.id = $id")->result_array();
	}
	public function GetOneProductByID($id) {
		return $this->db->query("SELECT product.id, product.name, product.price, product.size, product.description, producttype.typeName FROM product, producttype WHERE product.typeCode = producttype.id and product.id = $id")->row_array();
	}
	public function InitOrderByUser($data) {
		$this->db->insert('orderbyuser',$data);
		return $this->db->insert_id();
	}
	public function GetOrderNoneByUser($user) {
		return $this->db->query("SELECT orderbyuser.id, orderbyuser.amoutProduct FROM orderbyuser WHERE orderbyuser.status = 0 and orderbyuser.userName = '$user'")->row_array();
	}
	public function InsertProductToOrderDetail($data) {
		$this->db->insert('orderdetail', $data);
		return $this->db->insert_id();
	}
	public function UpdateOderByUser($data,$userName) {
		$this->db->where('userName',$userName);
		return $this->db->update('orderbyuser',	$data);
	}
	public function GetOrderDetail($user) {
		return $this->db->query("SELECT orderbyuser.id as orderID,orderdetail.id , product.name, product.price, orderdetail.amount FROM orderbyuser, orderdetail, product WHERE orderbyuser.userName = '$user' and orderbyuser.id = orderdetail.orderByUserID and product.id = orderdetail.productID and orderbyuser.status = 0")->result_array();
	}
	public function DeleteProductSelectByIDDetail($id) {
		$this->db->where('id', $id);
		return $this->db->delete('orderdetail');
	}
	public function FinnishOrderByUser($id,$data) {
		$this->db->where('id', $id);
		return $this->db->update('orderbyuser',$data);
	}
	public function CheckGetProduct($productID,$orderID)
	{
		return $this->db->query("SELECT  orderdetail.id ,orderdetail.orderByUserID, orderdetail.productID, orderdetail.amount FROM orderdetail WHERE orderdetail.orderByUserID = $orderID and orderdetail.productID = $productID")->row_array();
	}
	public function UpdateCheckDetail($id,$data)
	{
		$this->db->where('id', $id);
		return $this->db->update('orderdetail', $data);
	}
	public function GetDetailAmountByID($id)
	{
		$this->db->select('amount');
		$this->db->where('id', $id);
		return $this->db->get('orderdetail')->row_array();
	}
	public function UpdateAmountDetailByID($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('orderdetail', $data);
	}
}

/* End of file SoftToy_model.php */
/* Location: ./application/models/SoftToy_model.php */