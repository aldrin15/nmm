<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inbox extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
	}
	
	public function index() {
		$id = 0;
		$data['main_content'] 	= 'inbox_view';
		$data['new_email'] 			= $this->admin_model->get_new_mail();
		$data['inbox'] 			= $this->admin_model->inbox($id);
		
		$this->load->view('includes/main_view', $data);
	}
	
	public function detail() {
		$id						= $this->uri->segment(4);		
		$data['details'] 		= $this->admin_model->mail_detail($id);
		$data['new_email'] 		= $this->admin_model->get_new_mail();
		$data['main_content'] 	= 'inbox_detail_view';
		
		$this->load->view('includes/main_view', $data);
	}
}