<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
	}
	
	public function index() {
		$data['main_content'] 	= 'event_view';
		$data['new_email'] 		= $this->admin_model->get_new_mail();
		$data['event'] 			= $this->admin_model->list_of_events();
	
		$this->load->view('includes/main_view', $data);
	}
	
	public function detail() {
		$id = $this->uri->segment(4);	
		$data['new_email'] 			= $this->admin_model->get_new_mail();		
		$data['details'] 			= $this->admin_model->passenger_detail($id);
		$data['main_content'] 		= 'passenger_detail_view';

		$this->load->view('includes/main_view', $data);
	}
}