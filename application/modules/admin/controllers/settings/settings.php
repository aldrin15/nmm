<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('admin_model');
	}
	
	public function index() {
		$id								= $this->session->userdata('user_id');	
		
		$data['analytics_count_data']	= $this->admin_model->analytics_count();
		$data['latest']					= $this->admin_model->get_latest_member();
		$data['new_email']				= $this->admin_model->get_new_mail();	
		$data['details'] 				= $this->admin_model->get_admin_user_detail($id);
		
		$data['main_content'] = 'settings_view';
		$this->load->view('includes/main_view', $data);
	}
}