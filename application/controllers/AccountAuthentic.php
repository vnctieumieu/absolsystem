<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AccountAuthentic extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->output->set_status_header(404);
	}
	public function Register() {	
		$this->load->helper('validator'); 
		$resdata['status'] = false;
		if ($this->input->post('repassword') !== $this->input->post('password')) {
			$resdata['msg'] = "Mật khẩu nhập lại chưa đúng";
		}
		else if (minMaxLength($this->input->post('password'), 8, 36)) {
			$resdata['msg'] = "Mật khẩu từ 8 đến 36 ký tự";
		}
		else if (!filter_var($this->input->post('email'),FILTER_VALIDATE_EMAIL)) {
			$resdata['msg'] = "Định dạng email không chính xác";
		}
		else {	
			$account['username'] = $this->input->post('username');
			$account['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
			$account['email'] = $this->input->post('email');
			$account['address'] = $this->input->post('address');
			$this->load->model('accountAuthentic_model');
			if ($this->accountAuthentic_model->insertAccount($account)) {
				$account['isAdmin'] = 0;
				$account['userName'] = $this->input->post('username');
				$account = array('account' => $account);
				$this->session->set_userdata($account);			
				$resdata['status'] = true;
				$resdata['msg'] = "Đăng ký thành công";
			}
		}
		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($resdata));
	}
	public function Login() {
		$resdata['status'] = false;
		$resdata['msg'] = "Tài khoản hoặc mật khẩu không chính xác";
		$userName = $this->input->post('userName');
		$password = $this->input->post('password');
		if (isset($userName) && isset($password)) {
			
			$account = $this->CheckLogin($userName,$password);
		}
		if ($account) {
			$account =  array('account' => $account);	
			$this->session->set_userdata($account);
			$resdata['status'] = true;
			$resdata['msg'] = "Đăng Nhập Thành Công";
		}
		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($resdata));
	}
	public function LogOut() {	
		$this->session->sess_destroy();
		redirect('Index','refresh');
	}
	public function CheckLogin($userName,$password) {
		$this->load->model('AccountAuthentic_model');
		$account = $this->AccountAuthentic_model->GetAccountByUserName($userName);
		if (isset($account)) {
			if (password_verify($password, $account['password'])) {
				return $account;
			}
		}
		return false;
	}
	public function LoadChangePassword() {
		$this->load->view('changePassword_view');
	}
	public function ChangPassword() {
		$accout_password = $this->session->userdata('account')['password'];
		$user = $this->session->userdata('account')['userName'];
		$old_password = $this->input->post('old_password');
		$new_password = $this->input->post('new_password');
		$renew_password = $this->input->post('renew_password');
		$this->load->model('AccountAuthentic_model');
		if (password_verify($old_password, $accout_password)) {
			if ($new_password == $renew_password) {
				$json['status'] = true;
				$json['msg'] = "Thành Công";
				$data['password'] = password_hash($new_password, PASSWORD_DEFAULT);
				if ($this->AccountAuthentic_model->UpdateAccount($user,$data)) {
					$this->session->sess_destroy();
					$this->output
					->set_content_type('application/json')
					->set_output(json_encode($json));
				} else {
					$json['status'] = false;
					$json['msg'] = "Kết nối sever thất bại";
					$this->output
					->set_content_type('application/json')
					->set_output(json_encode($json));
				}
			} else {
				$json['status'] = false;
				$json['msg'] = "Mật khẩu nhập lại không đúng";
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode($json));
			}
		} else {
			$json['status'] = false;
			$json['msg'] = "Mật khẩu không chính xác";
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode($json));
		}
	}
}

/* End of file accountAuthentic.php */
/* Location: ./application/controllers/accountAuthentic.php */