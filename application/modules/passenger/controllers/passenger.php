<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Passenger extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->_view_module 			= 'passenger';
		$this->_view_template_name 		= 'includes/';
		$this->_view_template_layout	= 'main_view';
		$this->_view_content			= '';
		
		$this->load->model('passenger_model');
		$this->load->library('form_validation');
	}
	
	public function index() {
		$data['wish_lift_data']		= $this->passenger_model->listing();
		$data['view_file']			= 'passenger_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function detail() {
		$id = $this->uri->segment('3');
		
		$data['wish_lift_detail'] 		= $this->passenger_model->detail($id);
		$data['preference_data'] 		= $this->passenger_model->preference($id);
		
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
		
		if($post):
			if(array_key_exists('wish_lift_submit', $post)):
				$this->form_validation->set_rules('origin', 'From', 'required');
				$this->form_validation->set_rules('destination', 'To', 'required');
				$this->form_validation->set_rules('dates', 'Dates', 'required');
				
				if($this->form_validation->run() == TRUE):
					$this->passenger_model->create_wish_lift();
					
					redirect('passenger/wish_lift_success', 'refresh');
				endif;
			endif;
		endif;	
	
		$data['view_file'] = 'passenger_create_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function wish_lift_success() {
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