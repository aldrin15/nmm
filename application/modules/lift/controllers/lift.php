<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lift extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->_view_module 			= 'lift';
		$this->_view_template_name 		= 'includes/';
		$this->_view_template_layout	= 'main_view';
		$this->_view_content 			= '';
		
		$this->load->model('lift_model');
		$this->load->library('form_validation');
	}
	
	public function index() {
		$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$query = parse_url($url, PHP_URL_QUERY);
		parse_str($query, $params);
		
		if(isset($params['from']) && isset($params['to'])):
			$data['ride_list'] = $this->lift_model->search_get_location();
			
			$post = $this->input->post();
			
			if($post):
				if(array_key_exists('ride_submit', $post)):
					$this->form_validation->set_rules('from', 'From', 'required');
					$this->form_validation->set_rules('to', 'To', 'required');
					
					if($this->form_validation->run() == TRUE):
						$data['ride_list'] = $this->lift_model->search_location();
					endif;
				endif;
			endif;
		else:
			$post = $this->input->post();
			
			if($post):
				if(array_key_exists('ride_submit', $post)):
					$this->form_validation->set_rules('from', 'From', 'required');
					$this->form_validation->set_rules('to', 'To', 'required');
					
					if($this->form_validation->run() == TRUE):
						$data['ride_list'] = $this->lift_model->search_location();
					else:
						$data['ride_list'] = $this->lift_model->listing();
					endif;
				endif;
			else:
				$data['ride_list'] = $this->lift_model->listing();
			endif;
		endif;
		
		$data['view_file'] = 'lift_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function seat_taken() {
		$listing = $this->lift_model->listing();
		
		foreach($listing as $row):
			echo $row['user_id'].' ';
			echo $row['origin'].' ';
			echo $row['available'].'<br />';
		endforeach;
		
		$seat_taken = $this->lift_model->seat_taken();
		
		echo '<pre>';
		var_dump($seat_taken);
		echo '</pre>';
	}
	
	public function create() {
		$post = $this->input->post();
		
		if($post):
			if(array_key_exists('create_lift_submit', $post)):
				$this->form_validation->set_rules('origin', 'From', 'required');
				$this->form_validation->set_rules('destination', 'To', 'required');
				$this->form_validation->set_rules('via', 'Via', 'required');
				$this->form_validation->set_rules('dates', 'Dates', 'required');
				$this->form_validation->set_rules('seat_amount', 'Seat Amount', 'required');
				
				if($this->form_validation->run() == TRUE):
					$this->lift_model->create_lift();
					
					redirect('lift/create_success', 'refresh');
				endif;
			endif;
		endif;
	
		$data['user_car_data'] = $this->lift_model->get_user_car($this->session->userdata('user_id'));
		$data['view_file'] = 'lift_create_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function create_success() {
		$data['view_file'] = 'lift_create_success_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function detail() {
		$id = $this->uri->segment(3);
		
		$data['lift_information'] = $this->lift_model->details($id);
		$data['view_file'] = 'lift_detail_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function quick_book_details() {
		$post_id = $this->input->get('post_id');
		
		$quick_book_data = $this->lift_model->quick_book_details($post_id);
		
		$quick_book_array = array();
		
		foreach($quick_book_data as $row):
			$quick_book_array[]	= $row;
		endforeach;
		
		echo json_encode($quick_book_array);
	}
	
	public function quick_book() {
		$user_id 		= $this->input->get('user_id');
		$post_id 		= $this->input->get('post_id');
		$seat_taken		= $this->input->get('seat_taken');
		$amount 		= $this->input->get('amount');
		$message 		= $this->input->get('message');
		$request 		= $this->input->get('request');
		$start_time		= $this->input->get('start_time');
		$date 			= date('Y-m-d', strtotime($this->input->get('date')));
		
		$this->lift_model->quick_booking($user_id, $post_id, $seat_taken, $amount, $message, $request, $start_time, $date);
	}
	
	public function search() {
		$post = $this->input->post();
		
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
		endif;
		
		$this->load->view('lift_search_view');
	}
	
	public function auto_suggest_city() {
		/*
		 * Note: This is script view only!
		 */
		$this->load->view('lift_auto_suggest_view');
	}
	
	public function auto_suggest() {
		$city = $this->input->get('city');

		$get_city = $this->lift_model->cities($city);
		
		$city_array = array();
		
		foreach($get_city as $cities):
			$city_array[] = $cities;
		endforeach;
		
		echo json_encode($city_array);
	}
	
	public function test_calendar() {
		$prefs = array (
		   'start_day'			=> 'saturday',
		   'month_type'			=> 'long',
		   'day_type'			=> 'short',
		   'show_next_prev'		=> TRUE,
		   'next_prev_url'   	=> base_url('lift/test_calendar')
		);

		$this->load->library('calendar', $prefs);

		echo $this->calendar->generate($this->uri->segment(3), $this->uri->segment(4));
	}
	
	public function insert_rating() {
		$user_id 		= $this->input->get('user_id');
		$rating_number 	= $this->input->get('rating_number');
		
		$this->lift_model->insert_rating($user_id, $rating_number);
	}
}