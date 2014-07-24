<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->model('admin_model');
	}
	
	public function index($msg = NULL) {
		$post = $this->input->post();
		
		/* if($post):
			$this->form_validation->set_rules('username', 'Username', 'required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
			
			if($this->form_validation->run() == TRUE):
				$result = $this->admin_model->login();
			endif;
		endif; */
		
		$data['msg']		= $msg;
		$this->load->view('login_view', $data);
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