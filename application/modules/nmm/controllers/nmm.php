<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nmm extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->_view_module				= 'nmm';
		$this->_view_template_name		= 'includes/';
		$this->_view_template_layout	= 'main_view';
		$this->_view_content			= '';
		
		$this->load->library('form_validation');
	}
	
	public function index() {
		modules::run('lang/index');
		
		$data['translate'] = $this->session->userdata('translate');		
		$data['view_file'] = 'index_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
}