<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Abroad extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->_view_module 			= 'abroad';
		$this->_view_template_layout 	= 'includes/';
		$this->_view_template_name 		= 'main_view';
		$this->_view_content			= '';
		
		$this->load->model('abroad_model');
	}
	
	public function index() {
		$data['countries_data']		= $this->abroad_model->country();
		$data['ride_default_data']	= $this->abroad_model->ride_by_country();
		$data['view_file']			= 'abroad_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_layout, $this->_view_template_name, $data);
	}
}