<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SoftToy extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
	}
	public function LoadViewSoftToy($idtype)
	{	
		$this->load->model('PokeMart/SoftToy/SoftToy_model');
		$arProduct = $this->SoftToy_model->GetProductByIdType($idtype);
		foreach ($arProduct as $key => $value) {
			$avatar = $this->SoftToy_model->GetAvatarProduct($value['id']);
			if ($avatar['picture']) {
				$arProduct[$key]['avatar'] = $avatar['picture'];
			}else {
				unset($arProduct[$key]);
			}
		}
		$data = array('arProduct' => $arProduct);
		$this->load->view('pokemart/SoftToy/softToy_view',$data,FALSE);
	}
	public function LoadViewSoftToySearch() {
		$infoSearch = $this->input->post('infoSearch');
		if ($infoSearch) {
			$this->load->model('PokeMart/SoftToy/SoftToy_model');
			$arProductBase = $this->SoftToy_model->GetProduct();
			$arProductResult = array();

			foreach ($arProductBase as $key => $value) {
				if (strpos(strtoupper($value['name']), strtoupper($infoSearch)) !== false) {
					$arProductResult[] = $value;
				}
			}
			foreach ($arProductResult as $key => $value) {
				$avatar = $this->SoftToy_model->GetAvatarProduct($value['id']);
				if ($avatar['picture']) {
					$arProductResult[$key]['avatar'] = $avatar['picture'];
				}else {
					unset($arProductResult[$key]);
				}
			}

			$sl = 0;
			foreach ($arProductResult as $key => $value) {
				$sl += 1;
			}
			echo "Số Lượng Tìm Thấy: ".$sl;
			$data = array('arProduct' => $arProductResult);
			$this->load->view('pokemart/SoftToy/softToy_view',$data,FALSE);
		}
	}
	public function ProductDetail($id)
	{	
		$this->load->model('PokeMart/SoftToy/SoftToy_model');
		$arProductPicture = $this->SoftToy_model->GetProductPictureByID($id);
		$productInfo = $this->SoftToy_model->GetOneProductByID($id);
		$productInfo['avatar'] = $arProductPicture[0]['picture'];
		$data = array('arProductPicture' => $arProductPicture, 'productInfo' => $productInfo );
		$this->load->view('pokemart/SoftToy/softToyDetail_view',$data,FALSE);
	}
	// Xử lý tạo đơn hàng và thêm đơn mới.
	public function InitOrderByUser($idProduct)
	{	
		$this->load->model('PokeMart/SoftToy/SoftToy_model');
		if (!$this->session->userdata('account')) {
			$json['status'] = false;
			$json['msg'] = "Xin lỗi vì sự bất tiện :( Bạn hãy đăng nhập trước nhé";
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($json));
		}
		if ($this->session->userdata('account')) {
			$dataInit['userName'] = $this->session->userdata('account')['userName'];
			$dataInit['dateTime'] = strtotime('now');
			$orderIDNone = $this->SoftToy_model->GetOrderNoneByUser($dataInit['userName']);
			// kiểm tra xem có đơn nào chưa hoàn thành không
			if ($orderIDNone) {
				$insertOrderDetail['productID'] = $idProduct;
				$insertOrderDetail['orderByUserID'] = $orderIDNone['id'];
				// Check Get
				$checkGet = $this->SoftToy_model->CheckGetProduct($idProduct,$orderIDNone['id']);
				if ($checkGet) {
					$checkGet['amount'] += 1;
					$this->SoftToy_model->UpdateCheckDetail($checkGet['id'],$checkGet);
					$dataUpdate['amoutProduct'] = $orderIDNone['amoutProduct'] + 1;
					$this->SoftToy_model->UpdateOderByUser($dataUpdate,$dataInit['userName']);
				} else {
					$InsertProductToOrderDetail = $this->SoftToy_model->InsertProductToOrderDetail($insertOrderDetail);
					$dataUpdate['amoutProduct'] = $orderIDNone['amoutProduct'] + 1;
					$this->SoftToy_model->UpdateOderByUser($dataUpdate,$dataInit['userName']);
				}
				$json['status'] = true;
				$json['amountProduct'] = $dataUpdate['amoutProduct'];
				$json['msg'] = "(^.^) Thành Công";

			
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($json));
			} else {
				// tạo đơn mới
				$OrderID = $this->SoftToy_model->InitOrderByUser($dataInit);
				if (isset($OrderID)) {

					$insertOrderDetail['productID'] = $idProduct;
					$insertOrderDetail['orderByUserID'] = $OrderID;
					$InsertProductToOrderDetail = $this->SoftToy_model->InsertProductToOrderDetail($insertOrderDetail);
					if (isset($InsertProductToOrderDetail)) {
						$dataUpdate['amoutProduct'] = 1;
						$this->SoftToy_model->UpdateOderByUser($dataUpdate,$dataInit['userName']);
					}
					$json['status'] = true;
					$json['amountProduct'] = $dataUpdate['amoutProduct'];
					$json['msg'] = "(^.^) Thành Công";
   					
   					
					$this->output
					->set_content_type('application/json')
					->set_output(json_encode($json));
				}
			}
		}
	}
	public function LoadUserCartView()
	{	
		$this->load->model('PokeMart/SoftToy/SoftToy_model');
		$arDetail = $this->SoftToy_model->GetOrderDetail($this->session->userdata('account')['userName']);
		$arDetailMore['priceSum'] = 0;
		$arDetailMore['amoutProduct'] = 0;
		foreach ($arDetail as $key => $value) {
			if ($value['amount'] > 1) {
				for ($i=0; $i < $value['amount'] ; $i++) { 
					$arDetailMore['priceSum'] += $value['price'];
					$arDetailMore['amoutProduct'] += 1;
				}
			} else {
				$arDetailMore['priceSum'] += $value['price'];
				$arDetailMore['amoutProduct'] += 1;
			}
		}
		$data = array('arDetail' => $arDetail,'arDetailMore' => $arDetailMore);
		$this->load->view('pokemart/SoftToy/userCart_view',$data,FALSE);
	}
	public function DeleteProductSelectByIDDetail($id)
	{	
		$this->load->model('PokeMart/SoftToy/SoftToy_model');
		$amount = $this->SoftToy_model->GetDetailAmountByID($id);
		if ($amount['amount'] > 1) {
			$amountKQ['amount'] = $amount['amount'] - 1;
			$this->SoftToy_model->UpdateAmountDetailByID($id,$amountKQ);
			$json['status'] = true;
			$json['msg'] =":( xóa thành công";
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($json));
		} else {
			if ($this->SoftToy_model->DeleteProductSelectByIDDetail($id)) {
				$json['status'] = true;
				$json['msg'] =":( xóa thành công";
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($json));
			}
		}
	}
	public function FinnishOrderByUser($id)
	{
		$this->load->model('PokeMart/SoftToy/SoftToy_model');
		$data['status'] = 1;
		if ($this->SoftToy_model->FinnishOrderByUser($id,$data)){
			redirect('Index','refresh');
		}
	}
}

/* End of file SoftToy.php */
/* Location: ./application/controllers/SoftToy.php */