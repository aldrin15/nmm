<?php if ( !defined('BASEPATH') ) exit('No direct script access allowed');

class Passenger extends MX_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->model('admin_model');
	}
	
	public function index() {
		$data['new_email'] 		= $this->admin_model->get_new_mail();
		$data['passenger'] 			= $this->admin_model->list_of_passengers();
		$data['main_content'] = 'passenger_view';
		$this->load->view('includes/main_view', $data);
	}
	
	public function detail() {
		$id = $this->uri->segment(4);
		
		$data['details']		= $this->admin_model->get_passenger_detail($id);
		$data['new_email'] 		= $this->admin_model->get_new_mail();
		$data['main_content'] 	= 'passenger_detail_view';

		$this->load->view('includes/main_view', $data);
	}	
}