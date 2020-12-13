<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{	
		$this->load->model('Index_model');
		$homePageVideo = $this->Index_model->GetHomePageVideo();
		$homePagePoster = $this->Index_model->GetHomePagePoster();
		$data = array('homePageVideo' => $homePageVideo, 'homePagePoster' => $homePagePoster);
		$this->load->view('homePage_view',$data,FALSE);
	}
	public function UpdateHomePagePoster()
	{	
		$dataID = $this->input->post('hidden_id');
		$data['title'] = $this->input->post('edit-title');
		$data['datepost'] = strtotime("now");
		$data['content']= $this->input->post('edit-content');
		$this->load->model('Index_model');
		$this->Index_model->UpDataHomePagePoster($dataID,$data);
		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($data));
	}
	public function UpdateHomePageVideo()
	{
		$dataID = $this->input->post('hiddenid');
		$data['code'] = $this->input->post('youtubecode');
		$this->load->model('Index_model');
		if ($this->Index_model->UpDataHomePageVideo($dataID,$data)) {
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
		};
	}
	public function LoadHistoryOrder()
	{
		$this->load->model('Index_model');
		$arHistory = $this->Index_model->LoadHistoryOrder($this->session->userdata('account')['userName']);
		foreach ($arHistory as $key => $value) {
			$arProduct = $this->Index_model->LoadDetaiOrderByID($value['id']);

			$sumProduct = 0;
			$nameProduct = array();
			$sumAmoutProduct = 0;
			foreach ($arProduct as $key1 => $value1) {
				if ($value1['amount'] > 1) {
					for ($i=0; $i < $value1['amount'] ; $i++) { 
						$sumProduct += $value1['price'];
						$sumAmoutProduct += 1;
					}
					$nameProduct[] = $value1['name']." X ".$value1['amount'];
				} else {
					$sumProduct += $value1['price'];
					$nameProduct[] = $value1['name'];
					$sumAmoutProduct += 1;
				}
			}
			$arHistory[$key]['sumProduct'] = $sumProduct;
			$arHistory[$key]['nameProduct'] = $nameProduct;
			$arHistory[$key]['sumAmoutProduct'] = $sumAmoutProduct;
		}

		$arHistory = array('arHistory' => $arHistory);
		$this->load->view('historyOrder_view', $arHistory, FALSE);
	}
	public function LoadChangeAddress()
	{
		$this->load->view('changeAddress_view');
	}
	public function UpdateAddress()
	{	
		$data['address'] = $this->input->post('new_address');
		$this->load->model('Index_model');
		if ($this->Index_model->UpdateAddress($this->session->userdata('account')['userName'],$data)) {
			$json['status'] = true;
			$json['msg'] ="Thành Công Thay Đổi Địa Chỉ";
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($json));
		} else {
			$json['status'] = false;
			$json['msg'] ="Thất bại kiểm tra lại bạn nhé";
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($json));
		}
	}
}

/* End of file HomePage.php */
/* Location: ./application/controllers/HomePage.php */