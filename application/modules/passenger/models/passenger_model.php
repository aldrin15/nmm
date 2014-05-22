<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Passenger_model extends CI_Model {
	
	function listing() {
		$id = join(',', $this->session->userdata('passenger_data'));
		$query = $this->db->query("SELECT * FROM `user_passenger_booking` WHERE `id` IN ({$id})");
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
}