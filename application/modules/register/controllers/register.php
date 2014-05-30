<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->_view_module				= 'register';
		$this->_view_template_name		= 'includes/';
		$this->_view_template_layout	= 'main_view';
		$this->_view_content			= "";
		
		$this->load->model('register_model');
		$this->load->library('form_validation');
		
		if($this->session->userdata('user_id') == TRUE):
			redirect('nmm');
		endif;
	}
	
	public function index() {
		$post = $this->input->post();
		
		if($post):
			if(array_key_exists('register_submit', $post)):
				$this->form_validation->set_rules('firstname', 'Firstname', 'required|trim');
				$this->form_validation->set_rules('lastname', 'Lastname', 'required|trim');
				$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
				$this->form_validation->set_rules('password', 'Password', 'required|trim');
				$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[password]');
				$this->form_validation->set_rules('terms_condition', 'Terms and Condition', 'required');
				
				if($this->form_validation->run() == TRUE):
					$rand 		= random_string('unique');
					$message	= "Dear ".$this->input->post('email').",\n\nPlease click on below URL or paste into your browser to verify your Email Address\n\n ".base_url('register/verify/')."/".$rand."\n"."\n\nThanks\nAdmin Team";
					
					$this->register_model->insert($rand);
					
					modules::run('email/sendEmailVerification', $this->input->post('email'), $message);
					
					redirect('register/successful', 'refresh');
				endif;
				
			endif;
		endif;
	
		$data['view_file'] = 'register_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function successful() {
		$data['view_file'] = 'register_successful_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function verify() {
		$code = $this->uri->segment(3);
		
		$this->register_model->verify($code);
		
		$data['view_file'] = 'register_successfully_verify';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
}