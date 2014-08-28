<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}
	
	function login() {
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		
		$query = $this->db->get_where('user_admin', array('username'=>$username, 'password'=>$password, 'user_role'=>'admin'));
		
		if($query->num_rows == 1):
			$row = $query->row();
			
			$data = array(
				'id'		=> $row->id,
				'username'	=> $row->username,
				'password'	=> $row->password,
				'user_role'	=> $row->user_role
			);
			
			$this->session->set_userdata($data);
			
			return true;
		endif;
		
		return false;
	}
	
	function analytics_count($what = 'SUM(DISTINCT lift_seat_booked.co2) as co2, COUNT(DISTINCT user.user_id) as user, COUNT(DISTINCT user_lift_post.id) as lift, COUNT(DISTINCT user_wish_rides.id) as wish, COUNT(DISTINCT events.id) as events') {
		$query = $this->db->select($what)
								->from('user')
								->join('user_lift_post', 'user_lift_post.user_id = user.user_id', 'left')
								->join('user_wish_rides', 'user_wish_rides.user_id = user.user_id', 'left')
								->join('lift_seat_booked', 'lift_seat_booked.user_id = user.user_id', 'left')
								->join('events', 'events.user_id = user.user_id', 'left')
								->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;		
	}
	
	function get_latest_member($what = 'user.user_id, user.firstname, user.lastname,  user_address.city, user_address.country') {
		$query = $this->db->select($what)
							->from('user')
							->join('user_address', 'user_address.user_id = user.user_id', 'left')
							->order_by('date','desc')
							->limit(5)
							->get();
														
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function list_of_rides($what = '*') {
		$query = $this->db->select($what)
							->from('user_lift_post')
							->join('user', 'user.user_id = user_lift_post.user_id')
							->get();
	
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function list_of_passengers($what = '*') {
		$query = $this->db->select($what)
							->from('user_wish_rides')
							->join('user', 'user.user_id = user_wish_rides.user_id')
							->get();
	
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function list_of_users($what = 'user.user_id, firstname, lastname, gender, type, end_date') {
		$query = $this->db->select($what)
							->from('user')
							->join('subscription_type', 'subscription_type.subscription_id = user.subscription_type')
							->join('subscription', 'subscription.user_id = user.user_id')
							->get();
	
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function list_of_events($what = '*') {
		$query = $this->db->select($what)
							->from('events')
							->get();
	
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function get_table_field($table_name){
		$result = $this->db->list_fields($table_name);
		return $result;
	}
	
	function user_detail($id,$what = '*'){
		$query = $this->db->select($what)
							->from('user')
							->join('user_address', 'user_address.user_id = user.user_id')
							->where('user.user_id', $id)
							->get();
		$result = $query->result_array();
		if(count($result) == 0) return false;
		return $result;
	}
	
	function inbox($id, $what = 'user_admin.display_name, message.message_id, message.subject, user.firstname, user.lastname, message.date, message.is_read'){
		$query = $this->db->select($what)
							->from('message')
							->join('user_admin', 'user_admin.id = message.receiver_id')
							->join('user', 'user.user_id = message.sender_id')
							->where('message.user_role', 'admin')
							->get();
	
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function mail_detail($id, $what = 'user_admin.display_name, message.message_id, message.message, message.subject, user.firstname, user.lastname'){
		$query = $this->db->select($what)
							->from('message')
							->join('user_admin', 'user_admin.id = message.receiver_id')
							->join('user', 'user.user_id = message.sender_id')
							->where('message_id', $id)
							->get();
	
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function get_new_mail($what='COUNT(is_read) as new_mail'){
	$id = 0;
	$read = 0;
	$query = $this->db->select($what)
							->from('message')
							->where('receiver_id', $id)
							->where('is_read', $read)
							->get();
	$result = $query->result_array();
	if(count($result) == 0) return FALSE;
	return $result;
	}
	
	function get_lift_detail($id, $what='user.firstname, user.lastname, user_lift_post.route_from, user_lift_post.route_to, user_lift_post.available, user_lift_post.storage, user_lift_post.remarks, user_lift_post.amount, user_lift_post.start_time, number, phone'){
		$query = $this->db->select($what)
							->from('user_lift_post')
							->join('user', 'user.user_id = user_lift_post.user_id')
							->join('user_mobile', 'user_mobile.user_id = user_lift_post.user_id', 'left')
							->where('user_lift_post.id', $id)
							->get();
	
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function booked_by($id, $what = 'user.user_id, user_media.media_filename as image') {
		$query = $this->db->select($what)
							->from('lift_seat_booked')
							->join('user', 'user.user_id = lift_seat_booked.user_id')
							->join('user_media', 'user_media.user_id = user.user_id', 'left')
							->where('lift_seat_booked.post_id', $id)
							->get();
							
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function details($id, $what = "user_lift_post.id, user_lift_post.user_id as post_user_id, available") {
		$query = $this->db->select($what)
							->from('user_lift_post')
							->where('user_lift_post.id', $id)
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function get_user_lift_dates($user_id) {
		$query = $this->db->query("
			SELECT CONCAT( GROUP_CONCAT( id ) ) as id, CONCAT( GROUP_CONCAT( route_from SEPARATOR  '-' ) ) AS origins, CONCAT( GROUP_CONCAT( route_to SEPARATOR '-' ) ) AS destination, CONCAT( GROUP_CONCAT( DATE ) ) AS dates
			FROM user_lift_post
			WHERE user_id = {$user_id}
			GROUP BY user_id
		");
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function get_passenger_detail($id, $what='user.firstname, user.lastname, user_wish_rides.route_from, user_wish_rides.route_to, user_wish_rides.available, user_wish_rides.storage, user_wish_rides.remarks'){
		$query = $this->db->select($what)
							->from('user_wish_rides')
							->join('user', 'user.user_id = user_wish_rides.user_id')
							->where('user_wish_rides.id', $id)
							->get();
	
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function get_graph_data($month, $year, $what='SUM(amount) as amount, subscription.start_date as date'){
		$query = $this->db->select($what)
							->from('subscription')
							->join('subscription_type', 'subscription_type.subscription_id = subscription.subscription_type')
							->where('YEAR(subscription.start_date) >= ', $year) 
							->where('MONTH(subscription.start_date) >= ', 01) 
							->where('YEAR(subscription.start_date) <= ', $year) 
							->where('MONTH(subscription.start_date) <= ', $month) 
							->group_by('MONTH(subscription.start_date)')
							->get();
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function get_total_earnings($year, $what='SUM(subscription_type.amount) as total'){
		$query = $this->db->select($what)
								->from('user')
								->join('subscription', 'subscription.user_id = user.user_id', 'left')
								->join('subscription_type', 'subscription_type.subscription_id = subscription.subscription_type', 'left')
								->where('YEAR(subscription.start_date)', $year)	
								->get();
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;	
	}
	
}