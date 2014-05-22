<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function my_template($module_name, $template_name, $template_layout, $data) {
		$data['module_name'] = $module_name;
		$this->load->view($template_name . '/' . $template_layout, $data);
	}
}