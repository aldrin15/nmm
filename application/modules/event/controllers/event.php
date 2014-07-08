<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Event extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->_view_module 			= "event";
		$this->_view_template_name 		= "includes/";
		$this->_view_template_layout 	= "main_view";
		$this->_view_content 			= "";
		
		$this->load->library(array('form_validation', 'upload'));
		$this->load->model('event_model');
	}
	
	public function index() {
		$data['event_data'] = $this->event_model->listing();
		$data['view_file'] = 'event_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function detail() {
		$id = $this->uri->segment(3);
		
		$data['event_details_data'] = $this->event_model->detail($id);
		
		$event_detail = $data['event_details_data'];
		
		$data['event_details_lift_data']		= $this->event_model->detail_lift($event_detail);
		$data['event_details_passenger_data']	= $this->event_model->detail_passenger($event_detail);		
		$data['view_file'] 						= 'event_detail_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function create() {
		modules::run('login/is_logged_in');
		$user_id = $this->session->userdata('user_id');
	
		$post = $this->input->post();
		
		if($post):
			if(empty($_FILES['userfile']['name'])) {
				$this->form_validation->set_rules('event_type', 'Event Type', 'required');
				$this->form_validation->set_rules('title', 'Title', 'required');
				$this->form_validation->set_rules('city_country', 'City and Country', 'required');
				$this->form_validation->set_rules('address', 'Address', 'required');
				$this->form_validation->set_rules('date', 'Date/s', 'required');

				$data['errors'] = $this->upload->display_errors();
				
				if($this->form_validation->run() == TRUE):
					$this->event_model->create();
					
					redirect('event/success', 'refresh');
				endif;
			} else {
				$this->form_validation->set_rules('event_type', 'Event Type', 'required');
				$this->form_validation->set_rules('title', 'Title', 'required');
				$this->form_validation->set_rules('city_country', 'City and Country', 'required');
				$this->form_validation->set_rules('address', 'Address', 'required');
				$this->form_validation->set_rules('date', 'Date/s', 'required');
				
				if($this->form_validation->run() == TRUE):
					$config['allowed_types'] 	= 'jpg|jpeg|gif|png';
					$config['upload_path']		= realpath(APPPATH.'../assets/media_uploads/events');
					$config['file_name']		= 'event_'.substr(md5(rand()), 0, 7);
					
					$this->upload->initialize($config);
					$this->upload->do_upload();
					
					$image_data = $this->upload->data();
				
					$this->event_model->create($image_data);
					
					redirect('event/success', 'refresh');
				endif;				
			}
		endif;
		
		$data['country_data']	= $this->event_model->country();
		$data['view_file'] 	= 'event_create_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function get_city() {
		$city 		= $this->input->get('country');
		$get_city 	= $this->event_model->get_city($city);
		
		$city_array = array();
		
		foreach($get_city as $row):
			$city_array[] = $row['combined'];
		endforeach;
		
		echo json_encode($city_array);
	}
	
	public function success() {
		$data['view_file'] = 'event_create_success_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
}