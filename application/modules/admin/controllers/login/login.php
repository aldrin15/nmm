<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->model('admin_model');
	}
	
	public function index($msg = NULL) {
		$post = $this->input->post();
		
		if($this->session->userdata('id') == 1 && $this->session->userdata('user_role') == 'admin'):
			header('Location: dashboard');
		else:
			$data['msg']		= $msg;
			$this->load->view('login_view', $data);
		endif;
	}
	
	public function forgot_password() {
		$this->load->view('forgot_password_view');
	}
	
	public function validate() {
		$result = $this->admin_model->login();
		
		if(!$result):
			$msg = "<font color=red>Invalid username and/or password.</font>";
			$this->index($msg);
		else:
			redirect('admin/dashboard');
		endif;
	}
	
	public function logout() {
		$this->session->sess_destroy();
		redirect('admin/login');
	}
}