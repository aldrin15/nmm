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
/* 		if($this->session->userdata('validated')):
			$data['members_data'] = $this->member_model->members($this->session->userdata('user_id'));
			$data['view_file'] = 'members_view';
			echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
		else:
			redirect('nmm/index');
		endif; */
		
		$post = $this->input->post();
		
		if($post):
			if(array_key_exists('ride_submit', $post)):
				$this->form_validation->set_rules('from', 'From', 'required');
				$this->form_validation->set_rules('to', 'To', 'required');
				
				if($this->form_validation->run() == TRUE):
					$ride = $this->member_model->search_location();
					
					$ride_data = array();
					
					foreach($ride as $details):
						$ride_data[] = $details['id'];
					endforeach;
					
					$this->session->set_userdata('ride_data', $ride_data);
					
					redirect('lift','refresh');
				endif;
			/* elseif(array_key_exists('passenger_submit', $post)):
				$this->form_validation->set_rules('from', 'From', 'required');
				$this->form_validation->set_rules('to', 'To', 'required');
				
				if($this->form_validation->run() == TRUE):
					$passenger = $this->member_model->search_location();
					
					$passenger_data = array();
					
					foreach($passenger as $details):
						$passenger_data[] = $details['id'];
					endforeach;
					
					$this->session->set_userdata('passenger_data', $passenger_data);
					
					redirect('passenger','refresh');
				endif;
			endif; */
		endif;
		
		$data['members_data'] 	= $this->member_model->members($this->session->userdata('user_id'));
		$data['view_file'] 		= 'members_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function edit() {
	
		$user_id = $this->session->userdata('user_id');
	
		$post = $this->input->post();
		
		if($post):
			if(empty($_FILES['userfile']['name'])) {
				// $this->form_validation->set_rules('userfile', 'Upload Image', 'required'); This is working
				$this->form_validation->set_rules('about_me', 'About Me', 'required');
				$this->form_validation->set_rules('firstname', 'Firstname', 'required');
				$this->form_validation->set_rules('lastname', 'Lastname', 'required');
				$this->form_validation->set_rules('job', 'Job', 'required');
				$this->form_validation->set_rules('address_no', 'Home no.', 'required');
				$this->form_validation->set_rules('street', 'Street', 'required');
				$this->form_validation->set_rules('postal', 'Postal', 'required');
				$this->form_validation->set_rules('mobile', 'Mobile no.', 'required');

				$data['errors'] = $this->upload->display_errors();
				
				if($this->form_validation->run() == TRUE):
					$this->member_model->update($user_id);
					
					redirect('members/edit_success', 'refresh');
				endif;
			} else {
				$this->form_validation->set_rules('about_me', 'About Me', 'required');
				$this->form_validation->set_rules('firstname', 'Firstname', 'required');
				$this->form_validation->set_rules('lastname', 'Lastname', 'required');
				$this->form_validation->set_rules('job', 'Job', 'required');
				$this->form_validation->set_rules('address_no', 'Home no.', 'required');
				$this->form_validation->set_rules('street', 'Street', 'required');
				$this->form_validation->set_rules('postal', 'Postal', 'required');
				$this->form_validation->set_rules('mobile', 'Mobile no.', 'required');
				
				if($this->form_validation->run() == TRUE):
					$config['allowed_types'] 	= 'jpg|jpeg|gif|png';
					$config['upload_path']		= realpath(APPPATH.'../assets/media_uploads');
					
					$this->upload->initialize($config);
					$this->upload->do_upload();
					
					$image_data = $this->upload->data();
					
					$this->member_model->update($user_id);
					$this->member_model->update_media($user_id, $image_data);
					
					redirect('members/edit_success', 'refresh');
				endif;				
			}
			
		endif;
	
		$data['countries_list']	= $this->member_model->countries();
		$data['view_file']		= 'member_edit_profile_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function get_city() {
		$country_code 	= $this->input->get('country');
		$get_city 		= $this->member_model->get_city($country_code);
		
		$city = array();
		
		foreach($get_city as $row):
			$city_name = array($row->combined);
			$city_name = preg_replace('/^([^,]*).*$/', '$1', $city_name);
			
			$city[] = $city_name;
		endforeach;
		
		for($i = 0; $i < count($city); $i++):
			echo '<option>'.$city[$i][0].'</option>';
		endfor;
	}
	
	public function edit_success() {
		$data['view_file'] = 'member_edit_profile_success_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function settings() {
		$post = $this->input->post();
		$user_id = $this->session->userdata('user_id');
		
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
	
	public function test() {
		$city = $this->input->get('city');
		
		$get_city = $this->member_model->cities($city);
		
		foreach($get_city as $row):
			echo '<li><a href="#" data-city="'.$row->combined.'">'.$row->combined.'</a></li>';
		endforeach;
	}
}