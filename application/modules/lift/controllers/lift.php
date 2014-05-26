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
		$user_id 	= $this->input->get('user_id');
		$from 		= $this->input->get('from');
		$to 		= $this->input->get('to');
		$seat_taken = $this->input->get('seat_taken');
		$amount 	= $this->input->get('amount');
		$message 	= $this->input->get('message');
		$request 	= $this->input->get('request');
		$date 		= date('Y-m-d', strtotime($this->input->get('date')));
	
		$this->lift_model->booking($user_id, $from, $to, $seat_taken, $amount, $message, $request, $date);
	}
}