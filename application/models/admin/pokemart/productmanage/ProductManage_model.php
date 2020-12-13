<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProductManage_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
	}
	// Lấy ds loại sản phẩm
	public function GetProductType()
	{
		$this->db->select('*');
		return $this->db->get('producttype')->result_array();
	}
	// thêm loại sản phẩm
	public function InsertProductType($data)
	{
		$this->db->insert('producttype', $data);
		return $this->db->insert_id();
	}
	// xóa loại sản phẩm theo id
	public function DeleteProductTypeByID($id)
	{	
		$this->db->where('id', $id);
		return $this->db->delete('producttype');
	}
	// cập nhật loại sản phẩm
	public function UpdateProductTypeByID($id,$data)
	{
		$this->db->where('id', $id);
		return $this->db->update('producttype', $data);
	}
	// lấy ds sản phẩm 
	public function GetProductByType($idProductType)
	{	
		return $this->db->query("Select product.id, product.name, product.price, product.itemsLove, product.size, product.status FROM product join producttype ON producttype.id = product.typeCode  WHERE producttype.id = $idProductType")->result_array();
	}
	// Insert Sản phẩm
	public function InsertProduct($data)
	{
		$this->db->insert('product', $data);
		return $this->db->insert_id();
	}
	// Delete sản phẩm
	public function DeleteProduct($id)
	{	
		$this->db->where('id', $id);
		return $this->db->delete('product');
	}
	// Update sản phẩm
	public function UpdateProduct($id,$data)
	{
		$this->db->where('id', $id);
		return $this->db->update('product', $data);
	}
	// Get Description Product
	public function GetDescriptionProductByID($id)
	{
		$this->db->select('description');
		$this->db->where('id', $id);
		return $this->db->get('product')->row_array();
	}
	public function UpdateDescription($id,$data)
	{
		$this->db->where('id', $id);
		return $this->db->update('product', $data);
	}
	public function GetProductPictureByID($id)
	{
		return $this->db->query("SELECT pictureproduct.picture FROM product join pictureproduct ON product.id = pictureproduct.idProduct WHERE product.id = $id")->result_array();
	}
	public function InsertProductPicture($data)
	{	
		return $this->db->insert('pictureproduct', $data);
	}
	public function DeleteProductPictureByName($name)
	{
		$this->db->where('picture', $name);
		return $this->db->delete('pictureproduct');
	}
}

/* End of file ProductManage_model.php */
/* Location: ./application/models/ProductManage_model.php */
//query
// return $this->db->query("SELECT product.id, product.name, product.price, product.avarta, producttype.typeName FROM product join producttype ON producttype.id = product.typeCode")->result_array();
		//SELECT *
	// FROM product, producttype
	// WHERE product.typeCode = producttype.id

	// lay hinh theo id
	// SELECT pictureproduct.picture
	// FROM product join pictureproduct ON product.id = pictureproduct.idProduct
	// WHERE product.id = 3

 	 // $this->db->query("SELECT * FROM product, producttype,pictureproduct Where pictureproduct.idProduct = product.id and product.typeCode = producttype.id")-> result_array();

// SELECT product.id, product.name, product.price, product.size, product.itemsLove, pictureproduct.picture
// FROM product, producttype,pictureproduct 
// Where pictureproduct.idProduct = product.id and product.typeCode = producttype.id and product.status = 1 and producttype.id = 6
		