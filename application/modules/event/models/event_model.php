<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Event_model extends CI_Model {
	
	public function listing($what = '*') {
		$today 		= getdate();
		$get_date 	= $today['year'].'-'.$today['mon'].'-'.$today['mday'];
		$date 		= date('Y-m-d H:i:s', strtotime($get_date));
		
		$query = $this->db->select($what)
							->from('events')
							->where('date >=', $date)
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function detail($id, $what = 'events.user_id, title, city_country, address, events.date, image, remarks, firstname, lastname') {
		$query = $this->db->select($what)
							->from('events')
							->join('user', 'user.user_id = events.user_id')
							->where('events.id', $id)
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function detail_lift($event_detail, $what = 'user_lift_post.user_id, firstname, lastname, user_lift_post.route_from as origin, user_lift_post.route_to as destination, via, available, amount, start_time, user_lift_post.date') {
		$city_country_array 	= array();
		$date_array 			= array();
		
		foreach($event_detail as $row):
			$city_name = array($row['city_country']);
			$city_name = preg_replace('/^([^,]*).*$/', '$1', $city_name);		
			
			$city_country_array[] = $city_name;
			$date_array[] = date('Y-m-d', strtotime($row['date']));
		endforeach;
		
		$city_country = $city_country_array;
		
		$query = $this->db->select($what)
							->from('user_lift_post')
							->join('user', 'user.user_id = user_lift_post.user_id')
							->like('user_lift_post.route_to', $city_country[0][0], 'after')
							->where('user_lift_post.date', $date_array[0])
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function detail_passenger($event_detail, $what = 'user_wish_rides.id, user_wish_rides.route_from as origin, user_wish_rides.route_to as destination, user_wish_rides.via, user_wish_rides.date AS posted, available, firstname, lastname, CONCAT( GROUP_CONCAT( user_rating.rating_number ORDER BY user_rating.rating_number  ) ) as rating, media_filename as image') {
		$passenger_array = array();
		$date_array 			= array();
		
		foreach($event_detail as $row):
			$passenger_name = array($row['city_country']);
			$passenger_name = preg_replace('/^([^,]*).*$/', '$1', $passenger_name);	
			
			$passenger_array[] = $passenger_name;
			$date_array[] = date('Y-m-d', strtotime($row['date']));
		endforeach;
		
		$passenger = $passenger_array;
		
		$query = $this->db->select($what)
							->from('user_wish_rides')
							->join('user', 'user.user_id = user_wish_rides.user_id', 'left')
							->join('user_rating', 'user_rating.user_id = user_wish_rides.user_id', 'left')
							->join('user_media', 'user_media.user_id = user_wish_rides.user_id', 'left')
							->like('user_wish_rides.route_to', $passenger[0][0], 'after')
							->where('user_wish_rides.date', $date_array[0])
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function create($image_data) {
		$today = getdate();
		$now = $today['year'].'-'.$today['mon'].'-'.$today['mday'];
		
		$data = array(
			'user_id'		=> $this->session->userdata('user_id'),
			'event_type' 	=> $this->input->post('event_type'),
			'title'			=> $this->input->post('title'),
			'city_country'	=> $this->input->post('city_country'),
			'address'		=> $this->input->post('address'),
			'date'			=> $this->input->post('date').' '.$this->input->post('hour').':'.$this->input->post('minute').':00',
			'image'			=> ($image_data != '') ? $image_data['file_name'] : "",
			'remarks'		=> $this->input->post('remarks'),
			'date_created'	=> $now,
		);
		
		$this->db->insert('events', $data);
	}
	
	/* ==========================
	 * Populate City by Country
	 * ======================= */
	function get_city($city) {
		$query = $this->db->query("SELECT DISTINCT `combined` FROM (`user_cities`) WHERE `combined` LIKE '{$city}%'");

		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function country($what = '*') {
		$query = $this->db->select($what)
							->from('countries')
							->where('continent_code', 'EU')
							->get();
							
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function featured_event($what = 'id, title, image') {
		$today 		= getdate();
		$get_date 	= $today['year'].'-'.$today['mon'].'-'.$today['mday'];
		$date 		= date('Y-m-d H:i:s', strtotime($get_date));
		
		$query = $this->db->select($what)
							->from('events')
							->where('date >=', $date)
							->limit('4')
							->order_by('id', 'desc')
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
}