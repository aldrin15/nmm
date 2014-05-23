<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Passenger_model extends CI_Model {
	
	function search_location() {
		$from = $this->input->post('from');
		$to = $this->input->post('to');
		
		$query = $this->db->query("SELECT * FROM  `user_passenger_booking` WHERE  `route_from` LIKE  '{$from}' AND  `route_to` LIKE  '{$to}' AND  `date` IS NOT NULL");
	
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function listing($what = '*') {
		$query = $this->db->select($what)
							->from('user_passenger_booking')
							->join('user', 'user.user_id = user_passenger_booking.user_id')
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
}