<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lift extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->_view_module 			= 'lift';
		$this->_view_template_name 		= 'includes/';
		$this->_view_template_layout	= 'main_view';
		$this->_view_content 			= '';
		
		$this->load->model('lift_model');
		$this->load->library(array('form_validation', 'encrypt'));
	
		$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->session->set_userdata('refered_from', $url);
	}
	
	public function index() {
		$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$query = parse_url($url, PHP_URL_QUERY);
		parse_str($query, $params);
		
		$post = $this->input->post();
		
		if(isset($params['from'])):
			$from	= $params['from'];
			$to 	= $params['to'];
			
			$data['ride_list'] = $this->lift_model->search_get_location($from, $to);
			
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
		modules::run('login/is_logged_in');
		
		if($this->uri->segment(3) != ''):
			$data['get_wish_data'] = $this->lift_model->get_wish($this->uri->segment(3));
			$data['get_wish_date'] = $this->lift_model->get_wish_date($this->uri->segment(3));
		else:
			$data['get_wish_data'] = '';
			$data['get_wish_date'] = '';
		endif;
		
		$post = $this->input->post();
		
		if($post):
			if(array_key_exists('create_lift_submit', $post)):
				$this->form_validation->set_rules('origin', 'From', 'required');
				$this->form_validation->set_rules('destination', 'To', 'required');
				// $this->form_validation->set_rules('via', 'Via', 'required');
				$this->form_validation->set_rules('dates', 'Dates', 'required');
				$this->form_validation->set_rules('seat_amount', 'Seat Amount', 'required|numeric');
				
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
		
		$data['lift_information'] 		= $this->lift_model->details($id);
		
		foreach($data['lift_information'] as $row):
			$user_id = $row['post_user_id'];
			$data['get_user_lift_dates']	= $this->lift_model->get_user_lift_dates($user_id);
		endforeach;
		$data['preference_data']		= $this->lift_model->preference($id);
		$data['get_user_image'] 		= $this->lift_model->get_user_image();
		
		$data['view_file'] 				= 'lift_detail_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function get_lift_post() {
		$id = $this->input->get('id');
		
		/*
		 * Decrypt Data
		 */
		function decrypt($action, $string) {
			$output = false;
			$key = 'My strong random secret key';
			// initialization vector 
			$iv = md5(md5($key));

			if( $action == 'decrypt' ){
				$output = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, $iv);
				$output = rtrim($output, "");
			}
			return $output;
		}
		
		$post_id = decrypt('decrypt', $id);
		
		$data['lift_dates_data'] = $this->lift_model->get_lift_post($post_id);
		
		echo json_encode($data['lift_dates_data']);
	}
	
	function get_lift_booked() {
		$id = $this->input->get('id');
		$date = $this->input->get('date');
		
		if(isset($_GET['date'])):
			/* Decrypt Data */
			function decrypt($action, $string) {
				$output = false;
				$key = 'My strong random secret key';
				// initialization vector 
				$iv = md5(md5($key));

				if( $action == 'decrypt' ){
					$output = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, $iv);
					$output = rtrim($output, "");
				}
				return $output;
			}
			
			$post_id = decrypt('decrypt', $id);
		
			$data['lift_seat_booked']	= $this->lift_model->lift_seat_booked($post_id, $date);
			
			if($data['lift_seat_booked'] == false):
				echo json_encode(array('message'=>'empty'));
			else:
				echo json_encode($data['lift_seat_booked']);
			endif;
		else:
			echo json_encode(array('message'=>'empty'));
		endif;		
	}
	
	public function insert_ride() {
		$this->lift_model->booked_user();
	}
	
	public function quick_book_details() {
		$token = $this->input->get('token');

		/*
		 * Decrypt Data
		 */
		function decrypt($action, $string) {
			$output = false;
			$key = 'My strong random secret key';
			// initialization vector 
			$iv = md5(md5($key));

			if( $action == 'decrypt' ){
				$output = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, $iv);
				$output = rtrim($output, "");
			}
			return $output;
		}
		
		$user_id = decrypt('decrypt', $token);
		
		$quick_book_data = $this->lift_model->book_details($user_id);
		
		$quick_book_array = array();
		
		foreach($quick_book_data as $row):
			$quick_book_array[]	= $row;
		endforeach;
		
		echo json_encode($quick_book_array);
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
	
	public function insert_rating() {
		$user_id 		= $this->input->get('user_id');
		$rating_number 	= $this->input->get('rating_number');
		
		$this->lift_model->insert_rating($user_id, $rating_number);
	}
	
	public function rides_count() {
		$data['rides'] 		= $this->lift_model->rides();
		
		foreach($data['rides'] as $row):
			echo $row['rides'];
		endforeach;
	}
}