<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nmm_model extends CI_Model {
	function test() {
		// $query = $this->db->distinct()->select('*')->from('user_cities')->get();
		// $query = $this->db->query("SELECT DISTINCT  `country_code` FROM `user_cities`"); This is working
		$query = $this->db->get_where('countries', array('continent_code' => 'EU'));

		return $query->result();
	}
	
	function test2() {
		$query = $this->db->get_where('user_cities', array('country_code' => 'ad'));

		return $query->result();	
	}
}