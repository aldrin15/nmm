<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Admin extends MX_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->_view_module 			= 'admin/admin';
		$this->_view_template_name 		= '/includes';
		$this->_view_template_layout 	= 'main_view';
		$this->_view_content			= '';
		
		$this->library->model('admin_model');
	}
	
	public function index() {
		$data['view_file'] = 'login_view';
		echo modules::run('template/admin_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
}