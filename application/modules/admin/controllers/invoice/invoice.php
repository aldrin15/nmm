<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('admin_model');
	}
	
	public function index() {
		if($this->session->userdata('user_role') == 'admin'):
			$data['analytics_count_data']	= $this->admin_model->analytics_count();
			$data['latest']					= $this->admin_model->get_latest_member();
			$data['new_email']				= $this->admin_model->get_new_mail();
			$data['main_content']	= 'invoice_view';
			$this->load->view('includes/main_view', $data);
		else:
			redirect('admin/login');
		endif;
	}
}