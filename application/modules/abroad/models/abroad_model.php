<?php if( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Abroad_model extends CI_Model {
	public function country($what = 'code, name') {
		$query = $this->db->select($what)
							->from('countries')
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function ride_by_country($what = 'route_from as origin, route_to as destination, via, amount, available, storage, start_time, date') {
		$date = getdate();
		$today = $date['year'].'-'.$date['mon'].'-'.$date['mday'];
		
		$query = $this->db->select($what)
							->from('user_lift_post')
							->where('date', $today)
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
}