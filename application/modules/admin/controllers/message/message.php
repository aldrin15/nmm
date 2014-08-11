<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Message extends MX_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->model('admin_model');
	}
	
	public function inbox() {
		if($this->session->userdata('user_role') == 'admin'):
			$id = 1;
			
			$data['new_email'] 		= $this->admin_model->get_new_mail();
			$data['inbox'] 			= $this->admin_model->inbox($id);		
			$data['main_content'] 	= 'inbox_view';
			$this->load->view('includes/main_view', $data);
		else:
			redirect('admin/login');
		endif;
	}
	
	public function sent() {
		if($this->session->userdata('user_role') == 'admin'):
			$data['main_content'] = 'sent_view';
			$this->load->view('includes/main_view', $data);
		else:
			redirect('admin/login');
		endif;
	}
}