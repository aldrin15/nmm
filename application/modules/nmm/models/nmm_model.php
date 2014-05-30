<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nmm_model extends CI_Model {

	public function cities($city) {
	
		$query = $this->db->query("SELECT DISTINCT `combined` FROM (`user_cities`) WHERE `combined` LIKE '%{$city}%'");
		
		$result = $query->result();
		if(count($result) == 0) return FALSE;
		return $result;
	}

	function test() {
		$query = $this->db->get_where('countries', array('continent_code' => 'EU'));

		return $query->result();
	}
	
	function test2() {
		$query = $this->db->get_where('user_cities', array('country_code' => 'ad'));

		return $query->result();	
	}
}