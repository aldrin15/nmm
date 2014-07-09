<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->_view_module 			= 'login';
		$this->_view_template_name 		= 'includes/';
		$this->_view_template_layout	= 'main_view';
		$this->_view_content 			= '';
		
		$this->load->library('form_validation');
        $this->load->model('login_model');
		
		$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->session->set_userdata('referred_from', $url);
	}
	
    public function index($msg = NULL){
		$is_logged_in = $this->session->userdata('validated');
		
		if(!isset($is_logged_in) || $is_logged_in !== true):
			$data['msg']		= $msg;
			$data['view_file']	= 'login_view';
			echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
		endif;
    }
	
	public function check_user() {
		$email = $this->input->get('email');
		
		$result = $this->login_model->fb_validate($email);
			
		if(!$result):
			echo "Denied";
		else:
			echo "Success";
		endif;
	}
    
    public function process(){
        $result = $this->login_model->validate();
        
        if(!$result):
            $msg = '<font color=red>Invalid username and/or password.</font><br />';
            $this->index($msg);
        else:
			$now = new DateTime();
			
			$user_id	= $this->session->userdata('user_id');
			$ip 		= gethostbyname(trim(`hostname`));
			$last_login = $now->format('Y-m-d H:i:s');
			
			$this->login_model->user_sessions($user_id, $ip, $last_login);
			
            redirect($this->session->userdata('refered_from'));
        endif;
    }
	
	public function forgot_password($error_message = NULL) {
		$post = $this->input->post();
		
		if($post):
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
				
			if($this->form_validation->run() == TRUE):
				$this->login_model->forgot_account();
				
				redirect('login/forgot_password_success', 'refresh');
			endif;
		endif;

		$data['view_file'] = 'login_forgot_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function forgot_password_success() {
		$data['view_file'] = 'login_forgot_success_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function is_logged_in() {
		$is_logged_in = $this->session->userdata('validated');
		
		if($is_logged_in != true):
			redirect('login/index');
			
			die();
		endif;
	}
	
	public function logout() {
		$this->session->sess_destroy();
		
		redirect($_SERVER['HTTP_REFERER']);
	}
}