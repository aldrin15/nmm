<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->model('admin_model');
	}
	
	public function index() {
		if($this->session->userdata('user_role') == 'admin'):
			$data['analytics_count_data']	= $this->admin_model->analytics_count();
			$data['latest']					= $this->admin_model->get_latest_member();
			$data['new_email']				= $this->admin_model->get_new_mail();
			$m = date('m');
			$y = date('Y');
			$data['earnings'] 				= $this->admin_model->get_total_earnings($y);
			$data['graph']					= $this->admin_model->get_graph_data($m, $y);
			$data['main_content']			= 'dashboard_view';
			$this->load->view('includes/main_view', $data);
		else:
			redirect('admin/login');
		endif;
	}
}