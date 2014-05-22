<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lift_model extends CI_Model {
	
	function listing() {
		$id = join(',', $this->session->userdata('ride_data'));  
		$query = $this->db->query("SELECT * FROM `user_lift_booking` WHERE `id` IN ({$id})");
		
		return $query->result();
	}
}