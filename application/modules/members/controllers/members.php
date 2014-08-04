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
		
		modules::run('lang/index');
	}
	
	public function index() {
		modules::run('login/is_logged_in');
		
		$data['members_data'] 	= $this->member_model->members($this->session->userdata('user_id'));
		$data['translate'] 	= $this->session->userdata('translate');
		$data['view_file'] 		= 'members_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function profile_view() {
		$id					= $this->uri->segment(3);
		$data['get_co2'] 	= $this->member_model->co2($id);
		$data['translate'] 	= $this->session->userdata('translate');
		$data['profile_data']	= $this->member_model->get_profile($id);
		$data['rides_data']		= $this->member_model->rides_list($id);
		$data['passenger_data'] = $this->member_model->passenger_list($id);
		
		$data['view_file']		= 'member_profile_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function edit() {
		modules::run('login/is_logged_in');
		
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
					$config['upload_path']		= realpath(APPPATH.'../assets/media_uploads/');
					$config['encrypt_name']		= true;
					
					$this->upload->initialize($config);

					if (!$this->upload->do_upload()) {
						$error = array('error' => $this->upload->display_errors());
					} else {
						$image_data = $this->upload->data();
					}
					
					$this->member_model->update($user_id);
					$this->member_model->update_media($user_id, $image_data);
					
					// redirect('members/edit_success', 'refresh');
				endif;			
			}
		endif;
	
		$data['translate'] 	= $this->session->userdata('translate');
		$data['members_information']	= $this->member_model->member_information($this->session->userdata('user_id'));
		$data['profile_image_data']		= $this->member_model->member_profile_image($this->session->userdata('user_id'));			
		$data['countries_list']			= $this->member_model->countries();
		$data['view_file']				= 'member_edit_profile_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function inbox() {
		modules::run('login/is_logged_in');
		
		$data['user_inbox_data']	= $this->member_model->inbox();
		$data['translate'] 	= $this->session->userdata('translate');
		$data['view_file']			= 'member_inbox_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function inbox_detail() {
		modules::run('login/is_logged_in');
		
		$id = $this->uri->segment(3);
		
		$data['user_inbox_data']	= $this->member_model->inbox_detail($id);
		$data['translate'] 	= $this->session->userdata('translate');
		$data['view_file'] 			= 'member_inbox_detail_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function sent() {
		modules::run('login/is_logged_in');
		
		$data['user_sent_data']	= $this->member_model->sent();
		$data['translate'] 	= $this->session->userdata('translate');
		$data['view_file']			= 'member_sent_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function sent_detail() {
		modules::run('login/is_logged_in');
		
		$id = $this->uri->segment(3);
		$data['user_sent_data']	= $this->member_model->sent_detail($id);
		$data['translate'] 	= $this->session->userdata('translate');
		$data['view_file'] 			= 'member_sent_detail_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function inbox_delete() {
		$this->member_model->inbox_delete();
		
		echo 'success';
	}
	
	public function message_delete() {
		$id = $this->uri->segment(3);
		
		$this->member_model->message_delete($id);
		
		echo 'Success';
	}
	
	public function car() {
		modules::run('login/is_logged_in');
		
		$id = $this->session->userdata('user_id');
		
		$data['car_data'] = $this->member_model->car($id);
		$data['translate'] 	= $this->session->userdata('translate');
		$data['view_file'] = 'member_car_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function car_edit() {
		modules::run('login/is_logged_in');
		
		$id = $this->session->userdata('user_id');
		
		$this->form_validation->set_rules('model', 'Car Model', 'required');
		$this->form_validation->set_rules('plate', 'Plate', 'required');
		$this->form_validation->set_rules('year', 'Year', 'required');
		$this->form_validation->set_rules('fuel', 'Fuel', 'required');
		
		if($this->form_validation->run() == TRUE):
			$this->member_model->car_update($id);
		endif;
		
		$data['car_data'] = $this->member_model->car($id);
		$data['translate'] 	= $this->session->userdata('translate');
		$data['view_file'] = 'member_car_edit_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function overview() {
		modules::run('login/is_logged_in');
		
		$id = $this->session->userdata('user_id');
		
		$data['rides_data'] = $this->member_model->rides_list($id);
		$data['passenger_data'] = $this->member_model->passenger_list($id);
		
		$data['translate'] 	= $this->session->userdata('translate');
		$data['view_file'] = 'member_overview_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function overview_ride_detail() {
		modules::run('login/is_logged_in');
		
		$id = $this->uri->segment(3);
		
		$data['ride_detail_data'] = $this->member_model->ride_detail($id);
		$data['translate'] 	= $this->session->userdata('translate');
		$data['view_file'] = 'member_overview_ride_detail_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function overview_ride_edit() {
		modules::run('login/is_logged_in');
		
		$id = $this->uri->segment(3);
		
		$data['translate'] 	= $this->session->userdata('translate');
		$data['view_file'] = 'member_overview_ride_edit_view';
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
		modules::run('login/is_logged_in');
		
		$data['translate'] 	= $this->session->userdata('translate');
		$data['view_file'] = 'member_edit_profile_success_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function settings() {
		modules::run('login/is_logged_in');
		
		$user_id = $this->session->userdata('user_id');
		
		$post = $this->input->post();
		
		if($post):
			if(array_key_exists('settings_submit', $post)):
				$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
				$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|xss_clean|matches[password]');
				
				if($this->form_validation->run()==TRUE):
					$this->member_model->update_settings($user_id);
					
					redirect('members/settings_success', 'refresh');
				endif;
			endif;
		endif;
		
		$data['members_id'] = $this->member_model->members($user_id);
		$data['translate'] 	= $this->session->userdata('translate');
		$data['view_file'] = 'member_settings_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function settings_success() {
		modules::run('login/is_logged_in');
		
		$data['view_file'] = 'member_settings_success_view';
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
	
	public function status() {
		$data['members_data'] 	= $this->member_model->members($this->session->userdata('user_id'));
		
		$this->load->view('member_status_view', $data);
	}
	
	public function member_count() {
		$count_data = $this->member_model->count_user();
		
		foreach($count_data as $count):
			echo $count['users'];
		endforeach;
	}
}