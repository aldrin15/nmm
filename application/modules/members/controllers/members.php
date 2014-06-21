<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Members extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->_view_module 			= "members";
		$this->_view_template_name 		= "includes/";
		$this->_view_template_layout 	= "main_view";
		$this->_view_content 			= "";
		
		$this->load->model('member_model');
		$this->load->library(array('form_validation', 'upload'));
		$this->load->helper('form');
		
		modules::run('login/is_logged_in');
	}
	
	public function index() {
		$data['members_data'] 	= $this->member_model->members($this->session->userdata('user_id'));
		
		$data['view_file'] 		= 'members_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function edit() {
	
		$user_id = $this->session->userdata('user_id');
	
		$post = $this->input->post();
		
		if($post):
			if(empty($_FILES['userfile']['name'])) {
				$this->form_validation->set_rules('firstname', 'Firstname', 'required');
				$this->form_validation->set_rules('lastname', 'Lastname', 'required');
				$this->form_validation->set_rules('street', 'Street', 'required');
				$this->form_validation->set_rules('city_country', 'City and Country', 'required');
				$this->form_validation->set_rules('mobile', 'Mobile no.', 'required');
				$this->form_validation->set_rules('phone', 'Phone', 'required');

				$data['errors'] = $this->upload->display_errors();
				
				if($this->form_validation->run() == TRUE):
					$test = $this->member_model->update($user_id);
					
					redirect('members/edit_success', 'refresh');
				endif;
			} else {
				$this->form_validation->set_rules('firstname', 'Firstname', 'required');
				$this->form_validation->set_rules('lastname', 'Lastname', 'required');
				$this->form_validation->set_rules('street', 'Street', 'required');
				$this->form_validation->set_rules('city_country', 'City and Country', 'required');
				$this->form_validation->set_rules('mobile', 'Mobile no.', 'required');
				$this->form_validation->set_rules('phone', 'Phone', 'required');
				
				if($this->form_validation->run() == TRUE):
					$config['allowed_types'] 	= 'jpg|jpeg|gif|png';
					$config['upload_path']		= realpath(APPPATH.'../assets/media_uploads');
					$config['file_name']		= $user_id.'_'.substr(md5(rand()), 0, 7);
					
					$this->upload->initialize($config);
					$this->upload->do_upload();
					
					$image_data = $this->upload->data();
					
					$this->member_model->update($user_id);
					$this->member_model->update_media($user_id, $image_data);
					
					redirect('members/edit_success', 'refresh');
				endif;				
			}
		endif;
	
		$data['members_information']	= $this->member_model->member_information($this->session->userdata('user_id'));
		$data['countries_list']			= $this->member_model->countries();
		$data['view_file']				= 'member_edit_profile_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function car() {
		$id = $this->session->userdata('user_id');
		
		$data['car_data'] = $this->member_model->car($id);
		$data['view_file'] = 'member_car_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function get_location() {
		$city = $this->member_model->get_location($this->input->get('city'));
		
		$city_array = array();
		
		foreach($city as $row):
			$city_array[] = $row['combined'];
		endforeach;
		
		echo json_encode($city_array);
	}
	
	public function edit_success() {
		$data['view_file'] = 'member_edit_profile_success_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function settings() {
		$user_id = $this->session->userdata('user_id');
		
		$post = $this->input->post();
		
		if($post):
			if(array_key_exists('settings_submit', $post)):
				$this->form_validation->set_rules('email', 'Email', 'required|xss_clean');
				$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
				$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|xss_clean|matches[password]');
				
				if($this->form_validation->run()==TRUE):
					$this->member_model->update_settings($user_id);
					
					redirect('members/member_settings_success_view', 'refresh');
				endif;
			endif;
		endif;
		
		$data['members_id'] = $this->member_model->members($user_id);
		$data['view_file'] = 'member_settings_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function settings_success() {
		$data['view_file'] = 'member_settings_success_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function calendar() {
		$data['view_file'] = 'test_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	/*
	 * Trying to get through ajax
	 */
	public function calendar_data() {
		$date_array = $this->input->get('dates');
		
		$date = array();
		
		for($i = 0; $i < count($date_array); $i++):
			$date[] = $date_array[$i];
		endfor;
		
		$dates = implode(', ', $date);
		
		$this->db->query("INSERT INTO dates (`booking_dates`) VALUES('{$dates}')");
	}
}