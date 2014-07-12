<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Terms extends MX_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->_view_module				= 'terms';
		$this->_view_template_name		= 'includes/';
		$this->_view_template_layout	= 'main_view';
		$this->_view_content 			= '';
	}
	
	public function index() {
		$data['view_file'] = 'terms_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
}