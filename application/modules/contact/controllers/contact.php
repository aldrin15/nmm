<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->_view_module 			= 'contact';
		$this->_view_template_name 		= 'includes/';
		$this->_view_template_layout 	= 'main_view';
		$this->_view_content 			= '';
		
		$this->load->library('form_validation');
		
		modules::run('lang/index');
	}
	
	public function index() {
		$post = $this->input->post();
		
		if($post):
			if(array_key_exists('contact_submit', $post)):
				$this->form_validation->set_rules('name', 'Name', 'required');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
				$this->form_validation->set_rules('message', 'Message', 'required');
				
				if($this->form_validation->run() == TRUE):
					modules::run('email/contactEmail', $this->input->post('name'), $this->input->post('email'), $this->input->post('message'));
					
					redirect('contact/successfully');
				endif;
			endif;
		endif;
	
		$data['translate'] 	= $this->session->userdata('translate');
		$data['view_file'] = 'contact_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function successfully() {
		$data['translate'] 	= $this->session->userdata('translate');
		$data['view_file'] = 'contact_successfull_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
}