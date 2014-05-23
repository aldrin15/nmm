<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Passenger extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->_view_module 			= 'passenger';
		$this->_view_template_name 		= 'includes/';
		$this->_view_template_layout	= 'main_view';
		$this->_view_content			= '';
		
		$this->load->model('passenger_model');
		$this->load->library('form_validation');
	}
	
	public function index() {
		$post = $this->input->post();
		
		if($post):
			if(array_key_exists('ride_submit', $post)):
				$this->form_validation->set_rules('from', 'From', 'required');
				$this->form_validation->set_rules('to', 'To', 'required');
				
				if($this->form_validation->run() == TRUE):
					$data['passenger_list'] = $this->passenger_model->search_location();
				else:
					$data['passenger_list'] = $this->passenger_model->listing();
				endif;
			endif;
		else:
			$data['passenger_list'] = $this->passenger_model->listing();
		endif;
		
		$data['view_file'] = 'passenger_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
}