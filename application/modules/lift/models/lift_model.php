<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lift_model extends CI_Model {
	
	function search_location() {
		$from = $this->input->post('from');
		$to = $this->input->post('to');
		
		$query = $this->db->query("SELECT * FROM  `user_lift_booking` WHERE  `route_from` LIKE  '{$from}' AND  `route_to` LIKE  '{$to}' AND  `date` IS NOT NULL");
	
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function search_get_location() {
		$from = $this->input->get('from');
		$to = $this->input->get('to');
		
		$query = $this->db->query("SELECT * FROM  `user_lift_booking` WHERE  `route_from` LIKE  '{$from}' AND  `route_to` LIKE  '{$to}' AND  `date` IS NOT NULL");
	
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function listing($what = '*') {
		$query = $this->db->select($what)->from('user_lift_booking')->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function details($id) {
		$query = $this->db->get_where('user_lift_booking', array('user_id' => $id));
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function booking() {
		$user_id = $this->input->get('user_id');
		$seat_taken = $this->input->get('seat_taken');
		
		$data = array(
			'user_id' 		=> $user_id,
			'seat_taken' 	=> $seat_taken
		);
		
		$query = $this->db->insert('user_passenger_booking', $data);
	}
}