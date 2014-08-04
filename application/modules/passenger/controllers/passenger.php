<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Passenger extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->_view_module 			= 'passenger';
		$this->_view_template_name 		= 'includes/';
		$this->_view_template_layout	= 'main_view';
		$this->_view_content			= '';
		
		$this->load->model('passenger_model');
		$this->load->library(array('form_validation', 'pagination'));
		
		$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->session->set_userdata('refered_from', $url);
		
		modules::run('lang/index');
	}
	
	public function index() {
		$post = $this->input->post();
		
		if($post):
			$this->form_validation->set_rules('from', 'From', 'required');
			$this->form_validation->set_rules('to', 'To', 'required');
			
			if($this->form_validation->run() == TRUE):
				$data['wish_lift_data']		= $this->passenger_model->listing();
			else:
				$data['wish_lift_data']	= $this->passenger_model->listing();
			endif;
		else:
			$data['passenger_count'] 	= $this->passenger_model->passenger_count();
			$passenger_count			= $data['passenger_count'];

			$config 					= array();
			$config["base_url"] 		= base_url('passenger/index');
			$config["total_rows"] 		= $passenger_count[0]['passenger'];
			$config["per_page"] 		= 12;
			$config["uri_segment"] 		= 3;

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

			$page 						= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data['wish_lift_data']		= $this->passenger_model->listing($config["per_page"], $page);
			$data["passenger_links"] 	= $this->pagination->create_links();	
		endif;
		
		$data['translate'] 	= $this->session->userdata('translate');
		$data['view_file']	= 'passenger_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function detail() {
		$id = $this->uri->segment('3');
		
		$data['wish_lift_detail'] 		= $this->passenger_model->detail($id);
		
		foreach($data['wish_lift_detail'] as $row):
			$user_id = $row['post_user_id'];
			$data['get_user_wish_dates']	= $this->passenger_model->get_user_lift_dates($user_id);
		endforeach;
		
		$data['preference_data'] 		= $this->passenger_model->preference($id);
		$data['translate'] = $this->session->userdata('translate');
		$data['view_file']				= 'passenger_detail_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function get_user_lift_post() {
		$lift_post_data = $this->passenger_model->get_user_lift_post();
		$wish_date_data = $this->passenger_model->dates($this->input->get('id'));
	
		for($i = 0; $i < count($lift_post_data); $i++):
			$lift_post_array[] = $lift_post_data[$i]['dates'];
		endfor;
		
		$b = implode(',', $lift_post_array);
		$c = explode(',', $b);
		
		for($i = 0; $i < count($c); $i++):
			$date_array[] = $c[$i];
		endfor;
		
		for($i = 0; $i < count($wish_date_data); $i++):
			$date_array[] = $wish_date_data[$i]['dates'];
		endfor;
		
		$get_date 			= array_unique(array_diff_assoc($date_array, array_unique($date_array)));
		$get_date 			= array_values($get_date);
		$pass_date_array 	= array();
	
		foreach($get_date as $key=>$val):
			$pass_date_array[] = $get_date[$key];
		endforeach;
		
		$date_result = $this->passenger_model->return_user_lift_post($pass_date_array);
		
		if($date_result != ''):
			$result = array_filter($date_result);			
		else:
			$result = 0;
		endif;
		
		if($result == null):
			echo json_encode("empty");
		else:
			echo json_encode($result);
		endif;		
	}
	
	public function get_selected_lift_data() {
		$id = $this->input->get('id');
		$post = $this->input->get('post');
		
		$lift_date_data = $this->passenger_model->get_selected_lift($id);
		$wish_date_data = $this->passenger_model->dates($post);
		
		$date_array = array();
		
		foreach($lift_date_data as $row):
			$date_array[] = $row['dates'];
		endforeach;
		
		foreach($wish_date_data as $row):
			$date_array[] = $row['dates'];
		endforeach;
		
		$result = array_unique(array_diff_assoc($date_array, array_unique($date_array)));
		
		echo json_encode($result);
	}
	
	public function detail_user() {
		$id = $this->input->get('id');
		
		$user_info = $this->passenger_model->get_user_info($id);
		
		$user_data = array();
		
		foreach($user_info as $row):
			$user_data[] = $row;
		endforeach;
		
		echo json_encode($user_data);
	}
	
	public function send() {
		$this->passenger_model->send();
	}
	
	public function invite_me() {
		$this->passenger_model->invite_me();
	}
	
	public function create() {
		modules::run('login/is_logged_in');
		$post = $this->input->post();
		
		$data['translate'] = $this->session->userdata('translate');
		$data['view_file'] = 'passenger_create_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function insert_create() {
		$this->passenger_model->create_wish_ride();
	}
	
	public function wish_lift_success() {
		$data['translate'] = $this->session->userdata('translate');
		$data['view_file'] = 'passenger_wish_lift_success_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function test() {
		$test = $this->passenger_model->test();
		
		
		foreach($test as $row):
			echo '<div>'.$row['id'].'</div>';
			echo '<div>'.$row['user_id'].'</div>';
			echo '<div>'.$row['firstname'].'</div>';
			echo '<div>'.$row['lastname'].'</div>';
			echo '<div>'.$row['origins'].'</div>';
			echo '<div>'.$row['destination'].'</div>';
			echo '<div>'.$row['car'].'</div>';
			echo '<div>'.$row['plate'].'</div>';
			echo '<div>'.$row['last_login'].'</div>';
			
			$preference_id = explode(',', $row['p_id']);
			
			for($i = 0; $i < count($preference_id); $i++):
				echo $preference_id[$i];
			endfor;
			
			echo '<br />';
			
			$other_post_date = explode(',', $row['other_post_dates']);
			
			for($i = 0; $i < count($other_post_date); $i++):
				echo $other_post_date[$i].'<br />';
			endfor;
		endforeach;
	}
}