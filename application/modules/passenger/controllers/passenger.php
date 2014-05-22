<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Passenger extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->_view_module 			= 'passenger';
		$this->_view_template_name 		= 'includes/';
		$this->_view_template_layout	= 'main_view';
		$this->_view_content			= '';
		
		$this->load->model('passenger_model');
	}
	
	public function index() {
		$data['passenger_list'] = $this->passenger_model->listing();
		$data['view_file'] = 'passenger_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
}