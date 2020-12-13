<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProductManage extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		// $this->load->view('pokemart/template/main');
	}
	// Load Quản Lý Sản Phẩm Tính Năng
	public function LoadProductManage()
	{
		$this->load->view('admin/PokemartManage/ProductManage/main');
	}
	// Load thành phần quản lý loại sản phẩm
	public function LoadProductManageItem()
	{	
		$this->load->model('admin/pokemart/productmanage/ProductManage_model');
		$arProductType = $this->ProductManage_model->GetProductType();
		$arData = array ('arProductType' => $arProductType);
		$this->load->view('admin/PokemartManage/ProductManage/productTypeManage',$arData,FALSE);
	}
	public function InserProductType()
	{
		$data['typeName'] = $this->input->get_post('typeName');
		$data['status'] = $this->input->get_post('status');
		$this->load->model('admin/pokemart/productmanage/ProductManage_model');
		$data['id'] = $this->ProductManage_model->InsertProductType($data);
		if (isset($data['id'])) {
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
	}
	public function DeleteProductTypeByID($id)
	{
		$this->load->model('admin/pokemart/productmanage/ProductManage_model');
		if ($this->ProductManage_model->DeleteProductTypeByID($id)) {
			$data['status'] = true;
			$data['msg'] = "Thành Công";
		}
		else {
			$data['status'] = false;
			$data['msg'] = "Thất Bại";
		}

		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($data));
	}
	public function UpdateProductTypeByID()
	{
		$id = $this->input->get_post('typeID');
		$data['status'] = $this->input->post('status');
		$data['typeName'] = $this->input->post('typeName');
		// UpdateProductTypeByID
		$this->load->model('admin/pokemart/productmanage/ProductManage_model');
		if ($this->ProductManage_model->UpdateProductTypeByID($id,$data)) {
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
	}
	// Load thành phần quản lý sản phẩm
	public function LoadProductManageInner()
	{	
		// Get danh sách loại
		$this->load->model('admin/pokemart/productmanage/ProductManage_model');
		$arProductType = $this->ProductManage_model->GetProductType();
		$arData = array ('arProductType' => $arProductType);
		// Load View
		$this->load->view('admin/PokemartManage/ProductManage/productManageSelect_view',$arData,FALSE);
	}
	public function LoadProductByType()
	{	
		$this->load->model('admin/pokemart/productmanage/ProductManage_model');
		$id_product_type = $this->input->post('id_product_type');
		if (isset($id_product_type)) {
			$arProduct = $this->ProductManage_model->GetProductByType($id_product_type);
			$arData['arProduct'] = $arProduct;
			$arData['idTypeProduct'] = $id_product_type;
	 	}
	 	$this->load->view('admin/PokemartManage/ProductManage/productManage_view',$arData,FALSE);
	}
	public function InsertProduct()
	{
		$data['name'] = $this->input->get_post('name');
		$data['price'] = $this->input->get_post('price');
		$data['size'] = $this->input->get_post('size');
		$data['typeCode'] = $this->input->get_post('typeCode');
		$this->load->model('admin/pokemart/productmanage/ProductManage_model');
		$data['id'] = $this->ProductManage_model->InsertProduct($data);
		if (isset($data['id'])) {
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
	}
	public function DeleteProduct($id)
	{
		$this->load->model('admin/pokemart/productmanage/ProductManage_model');
		$arPicture = $this->ProductManage_model->GetProductPictureByID($id);
		if ($arPicture) {
			foreach ($arPicture as $key => $value) {
				 unlink("uploads/product/".$value['picture']);
			}
		}
		if ($this->ProductManage_model->DeleteProduct($id)) {
			$data['status'] = true;
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
	}

	public function UpdateProduct($id)
	{	
		$this->load->helper('validator_helper');
		$getid = $id;
		$json['statusJS'] = true;
		$json['msg'] = "";
		$data['name'] = $this->input->post('name');
		if (strlen($data['name']) > 25) {
				$json['statusJS'] = false;
				$json['msg'] = "Tên không được quá 25 ký tự";
		}

		$data['price'] = $this->input->post('price');
		if (!isNumber($data['price'])) {
			$json['statusJS'] = false;
			$json['msg'] .= "(^.^) Giá chỉ có thể là số";
		}

		$data['itemsLove'] = $this->input->post('items_Love');
		$data['itemsLove'] = strtoupper($data['itemsLove']);
		if ($data['itemsLove'] == "Y" || $data['itemsLove'] == "YES") {
			$data['itemsLove'] = 1;
		}else {
			$data['itemsLove'] = 0;
		}
		$data['size'] = $this->input->post('size_product');
		if (!isNumber($data['size'])) {
			$json['statusJS'] = false;
			$json['msg'] .= "(^.^) Size chỉ có thể là số";
		}
		
		$data['status'] = $this->input->post('status');
		$data['status'] = strtoupper($data['status']);
		if ($data['status'] == "N" || $data['status'] == "NO") {
			$data['status'] = 0;
		}else {
			$data['status'] = 1;
		}

		if ($json['statusJS'] == false) {
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($json));
		} else {
			$this->load->model('admin/pokemart/productmanage/ProductManage_model');
			if ($this->ProductManage_model->UpdateProduct($id, $data)) {
				$data['statusJS'] = true;
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($data));
			}

		}
	}
	public function GetDescriptionProduct($id)
	{
		$this->load->model('admin/pokemart/productmanage/ProductManage_model');
		$data = $this->ProductManage_model->GetDescriptionProductByID($id);
		if ($data['description']) {
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}else {
			$data['description'] ="";
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
	}
	public function UpdateDescription($id)
	{
		$strDescription = $this->input->get_post('strDescription');	
		$data['description'] = $strDescription;
		$this->load->model('admin/pokemart/productmanage/ProductManage_model');
		if ($this->ProductManage_model->UpdateDescription($id,$data)) {
			$json['status'] = true;
			$json['msg'] = "Thành Công";
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($json));
		}else {
			$json['status'] = false;
			$json['msg'] = "Thất Bại thử lại bạn nhé";
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($json));
		}
	}
	//Get ProductPicture
	public function GetProductPictureByID($id)
	{
		$this->load->model('admin/pokemart/productmanage/ProductManage_model');
		$data = $this->ProductManage_model->GetProductPictureByID($id);
		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($data));
	}
	public function InsertPictureProduct($id)
	{
		$data['picture'] = $this->CheckPicture('select-picture');
		$data['idProduct'] = $id;
		$this->load->model('admin/pokemart/productmanage/ProductManage_model');
		if ($this->ProductManage_model->InsertProductPicture($data)) {
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		}
	}
	public function CheckPicture($file)
	{
		$target_dir = "uploads/product/";
		$target_file = $target_dir . basename($_FILES[$file]["name"]);
		$File = basename($_FILES[$file]["name"]);
		$FileFile = explode( '.', $File);
		$fileTail =  $FileFile['1'];

		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$nametime = strtotime("now");
		// Xử lý file ảnh
		if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"
		|| $imageFileType == "gif" ) {
			move_uploaded_file($_FILES[$file]["tmp_name"], $target_file);
			rename($target_file, "$target_dir$nametime.$fileTail");
			return "$nametime.$fileTail";
		}
		return false;
	}
	public function DeleteProductPictureByName($name)
	{
		$this->load->model('admin/pokemart/productmanage/ProductManage_model');
		$this->ProductManage_model->DeleteProductPictureByName($name);
		unlink("uploads/product/$name");
		$json['name'] = $name;
		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($json));
	}
}