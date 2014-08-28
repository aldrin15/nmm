<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Members extends MX_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->model('admin_model');
	}
	
	public function index() {
		if($this->session->userdata('user_role') == 'admin'):
			$data['main_content'] 	= 'member_view';
			$data['new_email'] 		= $this->admin_model->get_new_mail();
			$data['user'] 			= $this->admin_model->list_of_users();	

			$this->load->view('includes/main_view', $data);
		else:
			redirect('admin/login');
		endif;
	}
	
	public function detail() {
		if($this->session->userdata('user_role') == 'admin'):
			$id = $this->uri->segment(4);	
			$data['new_email'] 			= $this->admin_model->get_new_mail();		
			$data['details'] 			= $this->admin_model->user_detail($id);
			$data['main_content'] 		= 'member_detail_view';

			$this->load->view('includes/main_view', $data);
		else:
			redirect('admin/login');
		endif;
	}
}