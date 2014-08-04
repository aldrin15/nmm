<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Privacy extends MX_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->_view_module 			= 'privacy';
		$this->_view_template_name		= 'includes/';
		$this->_view_template_layout 	= 'main_view';
		$this->_view_content 			= '';
		
		modules::run('lang/index');
	}
	
	public function index() {
		$data['translate'] 	= $this->session->userdata('translate');
		$data['view_file'] = 'privacy_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
}