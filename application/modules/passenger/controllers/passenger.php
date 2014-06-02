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
		$data['wish_lift_data']		= $this->passenger_model->listing();
		$data['view_file']			= 'passenger_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function create() {
		$post = $this->input->post();
		
		if($post):
			if(array_key_exists('wish_lift_submit', $post)):
				$this->form_validation->set_rules('origin', 'From', 'required');
				$this->form_validation->set_rules('destination', 'To', 'required');
				$this->form_validation->set_rules('dates', 'Dates', 'required');
				
				if($this->form_validation->run() == TRUE):
					$this->passenger_model->create_wish_lift();
					
					redirect('passenger/wish_lift_success', 'refresh');
				endif;
			endif;
		endif;	
	
		$data['view_file'] = 'passenger_create_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function wish_lift_success() {
		$data['view_file'] = 'passenger_wish_lift_success_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
}