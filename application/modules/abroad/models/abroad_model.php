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
	
	public function ride_by_country($what = 'id, route_from as origin, route_to as destination, via, amount, available, storage, start_time, date') {
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
	
	public function wish_ride_by_country($what = 'user_wish_rides.id, firstname, lastname, route_from as origin, route_to as destination, via, available, storage, start_time, CONCAT( GROUP_CONCAT( user_rating.user_id ) ) AS rating_id, CONCAT( GROUP_CONCAT( user_rating.rating_number ) ) rating, user_wish_rides.date') {
		$date = getdate();
		$today = $date['year'].'-'.$date['mon'].'-'.$date['mday'];
		
		$query = $this->db->select($what)
							->from('user_wish_rides')
							->join('user', 'user.user_id = user_wish_rides.user_id')
							->join('user_rating', 'user_rating.user_id = user.user_id')
							->where('user_wish_rides.date', $today)
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
}