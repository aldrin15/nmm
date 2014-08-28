<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lift extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->_view_module 			= 'lift';
		$this->_view_template_name 		= 'includes/';
		$this->_view_template_layout	= 'main_view';
		$this->_view_content 			= '';
		
		$this->load->model('lift_model');
		$this->load->library(array('form_validation', 'encrypt', 'pagination'));
	
		$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$url_path = parse_url($url, PHP_URL_PATH);
		$url_id = pathinfo($url_path, PATHINFO_BASENAME);
		
		foreach($this->router->routes as $key => $row):
			$method = '/nmm/'.str_replace('(:any)', $url_id, $key);
			
			if($method == $_SERVER['REQUEST_URI']):
				$url = 'http://'.$_SERVER['HTTP_HOST'].$method;
				
				$this->session->set_userdata('refered_from', $url);
			endif;
		endforeach;
		
		modules::run('lang/index');
	}
	
	public function index() {
		$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$query = parse_url($url, PHP_URL_QUERY);
		parse_str($query, $params);
		
		$post = $this->input->post();
		
		if(isset($params['from'])):
			$from	= $params['from'];
			$to 	= $params['to'];
			(isset($params['date'])) ? $date = $params['date'] : $date = '';
			(isset($params['amount'])) ? $amount = $params['amount'] : $amount = '';
			
			$data['ride_list'] = $this->lift_model->search_get_location($from, $to, $date, $amount);
			
			if($post):
				if(array_key_exists('ride_submit', $post)):
					$this->form_validation->set_rules('from', 'From', 'required');
					$this->form_validation->set_rules('to', 'To', 'required');
					
					if($this->form_validation->run() == TRUE):
						$data['ride_count'] 	= $this->lift_model->ride_where_count();
						$ride_count				= $data['ride_count'];
						
						$config 				= array();
						$config["base_url"] 	= base_url('rides/index');
						$config["total_rows"] 	= $ride_count[0]['rides'];
						$config["per_page"] 	= 12;
						$config["uri_segment"] 	= 3;
						
						$config['full_tag_open']	= '<ul class="pagination">';
						$config['cur_tag_open'] 	= '<li class="active"><a href="javascript:void(0)">';
						$config['cur_tag_close'] 	= '</a></li>';
						$config['num_tag_open'] 	= '<li>';
						$config['num_tag_close'] 	= '</li>';
						$config['prev_link'] 		= '&laquo;';
						$config['prev_tag_open'] 	= '<li>';
						$config['prev_tag_close'] 	= '</li>';
						$config['next_link'] 		= '&raquo;';
						$config['next_tag_open'] 	= '<li>';
						$config['next_tag_close'] 	= '</li>';
						$config['first_tag_open'] 	= '<li>';
						$config['first_tag_close'] 	= '</li>';
						$config['last_tag_open'] 	= '<li>';
						$config['last_tag_close'] 	= '</li>';				
						$config['full_tag_close'] 	= '</ul>';
						
						$this->pagination->initialize($config);
						
						$page 				= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
						$data['ride_list'] 	= $this->lift_model->search_location($config["per_page"], $page);
						$data["ride_links"] = $this->pagination->create_links();
					endif;
				endif;
			endif;
		else:
			if($post):
				if(array_key_exists('ride_submit', $post)):
					$this->form_validation->set_rules('from', 'From', 'required');
					$this->form_validation->set_rules('to', 'To', 'required');
					
					if($this->form_validation->run() == TRUE):
						$data['ride_count'] 	= $this->lift_model->ride_where_count();
						$ride_count				= $data['ride_count'];
						
						$config 				= array();
						$config["base_url"] 	= base_url('rides/index');
						$config["total_rows"] 	= $ride_count[0]['rides'];
						$config["per_page"] 	= 12;
						$config["uri_segment"] 	= 3;
						
						$config['full_tag_open']	= '<ul class="pagination">';
						$config['cur_tag_open'] 	= '<li class="active"><a href="javascript:void(0)">';
						$config['cur_tag_close'] 	= '</a></li>';
						$config['num_tag_open'] 	= '<li>';
						$config['num_tag_close'] 	= '</li>';
						$config['prev_link'] 		= '&laquo;';
						$config['prev_tag_open'] 	= '<li>';
						$config['prev_tag_close'] 	= '</li>';
						$config['next_link'] 		= '&raquo;';
						$config['next_tag_open'] 	= '<li>';
						$config['next_tag_close'] 	= '</li>';
						$config['first_tag_open'] 	= '<li>';
						$config['first_tag_close'] 	= '</li>';
						$config['last_tag_open'] 	= '<li>';
						$config['last_tag_close'] 	= '</li>';				
						$config['full_tag_close'] 	= '</ul>';
						
						$this->pagination->initialize($config);
						
						$page 				= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
						$data['ride_list'] 	= $this->lift_model->search_location($config["per_page"], $page);
						$data["ride_links"] = $this->pagination->create_links();
					else:
						$data['ride_list'] = $this->lift_model->listing();
					endif;
				endif;
			else:
				$data['ride_count'] 	= $this->lift_model->ride_count();
				$ride_count				= $data['ride_count'];
				
				$config 				= array();
				$config["base_url"] 	= base_url('rides/index');
				$config["total_rows"] 	= $ride_count[0]['rides'];
				$config["per_page"] 	= 12;
				$config["uri_segment"] 	= 3;
				
				$config['full_tag_open']	= '<ul class="pagination">';
				$config['cur_tag_open'] 	= '<li class="active"><a href="javascript:void(0)">';
				$config['cur_tag_close'] 	= '</a></li>';
				$config['num_tag_open'] 	= '<li>';
				$config['num_tag_close'] 	= '</li>';
				$config['prev_link'] 		= '&laquo;';
				$config['prev_tag_open'] 	= '<li>';
				$config['prev_tag_close'] 	= '</li>';
				$config['next_link'] 		= '&raquo;';
				$config['next_tag_open'] 	= '<li>';
				$config['next_tag_close'] 	= '</li>';
				$config['first_tag_open'] 	= '<li>';
				$config['first_tag_close'] 	= '</li>';
				$config['last_tag_open'] 	= '<li>';
				$config['last_tag_close'] 	= '</li>';				
				$config['full_tag_close'] 	= '</ul>';
				
				$this->pagination->initialize($config);
				
				$page 				= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
				
				$data["ride_list"] 	= $this->lift_model->listing($config["per_page"], $page);
				$data["ride_links"] = $this->pagination->create_links();
			endif;
		endif;
		
		$data['translate'] = $this->session->userdata('translate');
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
	}
	
	public function create() {
		modules::run('login/is_logged_in');
		
		$data['user_car_data'] = $this->lift_model->get_user_car($this->session->userdata('user_id'));
		$user_car_data = $data['user_car_data'];
		
		if($user_car_data[0]['car_model'] != ''):
			if($this->uri->segment(3) != ''):
				$data['get_wish_data'] = $this->lift_model->get_wish($this->uri->segment(3));
				$data['get_wish_date'] = $this->lift_model->get_wish_date($this->uri->segment(3));
			else:
				$data['get_wish_data'] = '';
				$data['get_wish_date'] = '';
			endif;
			
			$data['translate'] = $this->session->userdata('translate');
			$data['view_file'] = 'lift_create_view';
			echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
		else:
			redirect('members/car');
		endif;
	}
	
	public function insert_create() {
		$this->lift_model->create_lift();
	}
	
	public function create_success() {
		$data['translate'] = $this->session->userdata('translate');
		$data['view_file'] = 'lift_create_success_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function detail() {
		$id = $this->uri->segment(3);
		
		$data['lift_information'] 		= $this->lift_model->details($id);
		$data['passenger_information']	= $this->lift_model->booked_by($id);
		
		foreach($data['lift_information'] as $row):
			$user_id = $row['post_user_id'];
			$data['get_user_lift_dates']	= $this->lift_model->get_user_lift_dates($user_id);
		endforeach;
		
		$data['preference_data']		= $this->lift_model->preference($id);
		$data['get_user_image'] 		= $this->lift_model->get_user_image();
		
		$data['translate'] = $this->session->userdata('translate');
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
					$time 	= $this->input->post('hour').':'.$this->input->post('hour').':00';
					$hour	= $this->input->post('hour');
					$minute	= $this->input->post('minute');
					
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
					
					if($time != '' && $minute != ''):
						$where[] = 'time='.$time;
					endif;
					
					if(count($where)) {
						$query.= implode('&', $where);
					}
					
					header("location: rides?".$query);
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
	
	public function delete_expired_post() {
		$data = $this->lift_model->expired_post();
		
		echo '<pre>';
		var_dump($data);
		echo '</pre>';
	}
	
	public function featured_ride() {
		$featured_ride = $this->lift_model->featured_ride();
		
		if($featured_ride != ''):
			foreach($featured_ride as $row):
				echo "<div class='span2'>";
				
				if($row['image'] != ''):
					echo "<a href='".base_url('rides/detail').'/'.$row['id']."'><img src='".base_url('assets/media_uploads')."/".$row['image']."' alt=''/></a>";
				else:
					echo "<a href='".base_url('rides/detail').'/'.$row['id']."'><img src='".base_url('assets/images/page_template/no_car.jpg')."' alt=''/></a>";
				endif;
	
				echo "<div class='event-detail'>
							<p style='text-transform:capitalize;'>".$row['firstname'].' '.$row['lastname']."</p>
						</div>
				</div>";
			endforeach;
		else:
			echo '<div style="font-size:20px; text-align:center; border:1px solid #000; padding-top:60px; height:190px;">No Lift Posted Today</div>';
		endif;
	}
	
	public function co2_daily(){
		$data = $this->lift_model->get_co2_daily(date('Y-m-d'));

		foreach($data as $row):
			if($row->co2 != ''):
				echo $row->co2;
			else:
				echo '0';
			endif;
		endforeach;
	}
}