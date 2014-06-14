<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Offer_wish_lift extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->_view_module 			= "offer_wish_lift";
		$this->_view_template_name 		= "includes/";
		$this->_view_template_layout	= "main_view";
		$this->_view_content 			= "";
	}
	
	public function index() {
		$data['view_file'] = 'offer_wish_lift_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
}