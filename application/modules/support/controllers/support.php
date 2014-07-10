<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Support extends MX_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->_view_module				= 'support';
		$this->_view_template_name 		= 'includes/';
		$this->_view_template_layout 	= 'main_view';
		$this->_view_content 			= '';
	}
	
	public function index() {
		$data['view_file'] = 'support_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function menu_subtopic() {
		$data['view_file'] = 'menu_subtopic_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function faq() {
		$data['view_file'] = 'faq_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function driver() {
		$data['view_file'] = 'driver_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function rules() {
		$data['view_file'] = 'rules_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function payment() {
		$data['view_file'] = 'payment_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function tax() {
		$data['view_file'] = 'tax_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
}
