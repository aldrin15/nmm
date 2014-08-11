<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rides extends MX_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->load->model('admin_model');
	}
	
	public function index() {
		if($this->session->userdata('user_role') == 'admin'):
			$data['main_content'] 	= 'ride_view';
			$data['new_email'] 		= $this->admin_model->get_new_mail();
			$data['lift'] 			= $this->admin_model->list_of_rides();
			
			$this->load->view('includes/main_view', $data);
		else:
			redirect('admin/login');
		endif;
	}
	
	public function detail() {
		if($this->session->userdata('user_role') == 'admin'):
			$id = $this->uri->segment(4);
			
			$data['lift_information'] 		= $this->admin_model->details($id);
			$data['passenger_information']	= $this->admin_model->booked_by($id);
			
			foreach($data['lift_information'] as $row):
				$user_id = $row['post_user_id'];
				$data['get_user_lift_dates']	= $this->admin_model->get_user_lift_dates($user_id);
			endforeach;
			
			$data['details'] 				= $this->admin_model->get_lift_detail($id);
			$data['new_email'] 				= $this->admin_model->get_new_mail();
			$data['main_content'] 			= 'ride_detail_view';
			
			$this->load->view('includes/main_view', $data);
		else:
			redirect('admin/login');
		endif;
	}
}