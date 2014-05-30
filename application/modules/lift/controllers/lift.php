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
	
	public function detail() {
		$id = $this->uri->segment(3);
		
		$data['lift_information'] = $this->lift_model->details($id);
		$data['view_file'] = 'lift_detail_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function quick_book() {
		echo $user_id 	= $this->input->get('user_id');
		echo $from 		= $this->input->get('from');
		echo $to 		= $this->input->get('to');
		echo $car 		= $this->input->get('car_model');
		echo $plate 	= $this->input->get('plate');
		echo $seat_taken= $this->input->get('seat_taken');
		echo $amount 	= $this->input->get('amount');
		echo $message 	= $this->input->get('message');
		echo $request 	= $this->input->get('request');
		echo $start_time= $this->input->get('start_time');
		echo $end_time 	= $this->input->get('end_time');
		echo $date 		= date('Y-m-d', strtotime($this->input->get('date')));
	
		$this->lift_model->booking($user_id, $from, $to, $car, $plate, $seat_taken, $amount, $message, $request, $start_time, $end_time, $date);
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
		$this->load->view('lift_auto_suggest_view');
	}
}