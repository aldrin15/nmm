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
	}
	
    public function index($msg = NULL){
        // Load our view to be displayed
        // to the user
		$data['msg']		= $msg;
		$data['view_file']	= 'login_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
    }
    
    public function process(){
        $result = $this->login_model->validate();
        
        if(!$result):
            $msg = '<font color=red>Invalid username and/or password.</font><br />';
            $this->index($msg);
        else:
			$now = new DateTime();
			
			$user_id = $this->session->userdata('user_id');
			$ip = gethostbyname(trim(`hostname`));
			$last_login = $now->format('Y-m-d H:i:s');
			
			$this->login_model->user_sessions($user_id, $ip, $last_login);
/* 			$test = $this->login_model->user_sessions();
			
			var_dump($test); */
			
            redirect('nmm');
        endif;
    }
	
	public function forgot_password($error_message = NULL) {
		$post = $this->input->post();
		
		if($post):
			if(array_key_exists('forgot_submit', $post)):
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
				
				if($this->form_validation->run() == TRUE):
					$this->login_model->forgot_account();
				endif;
			endif;
		endif;

		$data['view_file'] = 'login_forgot_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function is_logged_in() {
		$is_logged_in = $this->session->userdata('validated');
		
		if(!isset($is_logged_in) || $is_logged_in !== true) {
			redirect('login/index', 'refresh');
			
			die();
		}
	}	
	
	public function logout() {
		$this->session->sess_destroy();
		redirect('nmm');
	}
}