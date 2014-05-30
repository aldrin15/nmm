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
		/* $post = $this->input->post();
		
		if($post):
			if(array_key_exists('ride_submit', $post)):
				$this->form_validation->set_rules('from', 'From', 'required');
				$this->form_validation->set_rules('to', 'To', 'required');
				
				if($this->form_validation->run() == TRUE):
					$from	= $this->input->post('from');
					$to		= $this->input->post('to');
					$date	= $this->input->post('date');
					
					$where = array();
					$query = NULL;
					
					if($from != ''):
						$where[] = 'from='.$from;
					endif;
					
					if($to != ''):
						$where[] = 'to='.$to;
					endif;
					
					if($date != ''):
						$where[] = 'date='.$date;
					endif;
					
					if(count($where)) {
						$query.= implode('&', $where);
					}
					
					header("location: lift?".$query);
				endif;
			endif;
		endif; */
		
		$data['members_data'] 	= $this->member_model->members($this->session->userdata('user_id'));
		
		// $this->session->set_userdata('members_detailed_information', );
		
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
	
	public function create_lift() {
		$post = $this->input->post();
		
		if($post):
			if(array_key_exists('create_lift_submit', $post)):
				$this->form_validation->set_rules('origin', 'From', 'required');
				$this->form_validation->set_rules('destination', 'To', 'required');
				$this->form_validation->set_rules('via', 'Via', 'required');
				$this->form_validation->set_rules('dates', 'Dates', 'required');
				$this->form_validation->set_rules('seat_amount', 'Seat Amount', 'required');
				
				if($this->form_validation->run() == TRUE):
					$this->member_model->create_lift();
				endif;
			endif;
		endif;
	
		$data['user_car_data'] = $this->member_model->get_user_car($this->session->userdata('user_id'));
		$data['view_file'] = 'member_create_lift_view';
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
	
	public function test() {
		$query = $this->db->query("
			SELECT user.user_id AS id, firstname, lastname, user_lift_post.route_from AS origin, user_lift_post.route_to AS destination, 
			STORAGE , user_car.car_model AS car, user_car.license_plate AS plate, available, amount, start_time, user_lift_post.date, 
			GROUP_CONCAT( user_lift_preference.preference_id ORDER BY user_lift_preference.preference_id SEPARATOR  ', ' ) AS p_id,
			GROUP_CONCAT( lift_preference.type ORDER BY lift_preference.preference_id SEPARATOR  ', ' ) AS TYPE
			FROM (
			 `user`
			)
			JOIN  `user_lift_post` ON  `user_lift_post`.`user_id` =  `user`.`user_id` 
			JOIN  `user_car` ON  `user_car`.`user_id` =  `user`.`user_id` 
			JOIN  `user_lift_preference` ON  `user_lift_preference`.`post_id` =  `user_lift_post`.`id`
			JOIN  `lift_preference` ON `lift_preference`.`preference_id` = `user_lift_preference`.`preference_id`
			WHERE  `user`.`user_id` =1
		");
		
		echo '<pre>';
		var_dump($query->result());
		echo '</pre>';
	}
}