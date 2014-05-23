<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nmm_model extends CI_Model {

	function test() {
		$query = $this->db->get_where('countries', array('continent_code' => 'EU'));

		return $query->result();
	}
	
	function test2() {
		$query = $this->db->get_where('user_cities', array('country_code' => 'ad'));

		return $query->result();	
	}
}