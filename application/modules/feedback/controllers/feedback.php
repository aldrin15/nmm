<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback extends MX_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->_view_module			= 'feedback';
		$this->_view_template_name	= 'includes/';
		$this->_view_template_name	= 'main_view';
		$this->_view_content		= '';
		
		$this->load->model('feedback_model');
	}
	
	public function index() {
		$data['feedback_data'] = $this->feedback_model->get_feedback();
		$this->load->view('feedback_view', $data);
	}
}