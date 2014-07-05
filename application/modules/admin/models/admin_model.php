<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}
	
	function analytics_count($what = 'COUNT(DISTINCT user.user_id) as user, COUNT(DISTINCT user_lift_post.id) as lift, COUNT(DISTINCT user_wish_lift.id) as wish, COUNT(DISTINCT events.id) as events') {
		$query = $this->db->select($what)
								->from('user')
								->join('user_lift_post', 'user_lift_post.user_id = user.user_id', 'left')
								->join('user_wish_lift', 'user_wish_lift.user_id = user.user_id', 'left')
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
							->from('user_wish_lift')
							->join('user', 'user.user_id = user_wish_lift.user_id')
							->get();
	
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function list_of_users($what = '*') {
		$query = $this->db->select($what)
							->from('user')
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
		return $query->result_array();	
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
	
	function get_lift_detail($id, $what='user.firstname, user.lastname, user_lift_post.route_from, user_lift_post.route_to, user_lift_post.available, user_lift_post.storage, user_lift_post.remarks, user_lift_post.amount, user_lift_post.start_time'){
		$query = $this->db->select($what)
							->from('user_lift_post')
							->join('user', 'user.user_id = user_lift_post.user_id')
							->where('user_lift_post.id', $id)
							->get();
	
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function get_passenger_detail($id, $what='user.firstname, user.lastname, user_wish_lift.route_from, user_wish_lift.route_to, user_wish_lift.available, user_wish_lift.storage, user_wish_lift.remarks'){
		$query = $this->db->select($what)
							->from('user_wish_lift')
							->join('user', 'user.user_id = user_wish_lift.user_id')
							->where('user_wish_lift.id', $id)
							->get();
	
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
}