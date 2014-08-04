<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Passenger_model extends CI_Model {
	
	function search_location() {
		$from 	= $this->input->post('from');
		$to 	= $this->input->post('to');
		$date 	= $this->input->post('date');
		
		$where = array();
		$query = NULL;
		
		if($from != ''):
			$where[] = "`route_from` Like '{$from}'";
		endif;
		
		if($to != ''):
			$where[] = "`route_to` Like '{$to}'";
		endif;
		
		if($date != ''):
			$where[] = "`date` <= '{$date} 24:00:01'";
		endif;
		
		if(count($where)):
			$query_result = "SELECT * FROM `user_passenger_booking` WHERE ".implode(' AND ', $where);
			$query = $this->db->query($query_result);
		endif;
	
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function listing($limit, $start) {
		$today 		= getdate();
		$get_date 	= $today['year'].'-'.$today['mon'].'-'.$today['mday'];
		$date 		= date('Y-m-d', strtotime($get_date));
		
		$query = $this->db->query("
			SELECT user_wish_rides.id, user_wish_rides.user_id, firstname, lastname, via, available, route_from AS origin, route_to AS destination, user_media.media_filename as image, CONCAT( GROUP_CONCAT( user_rating.user_id
			ORDER BY user_rating.user_id
			SEPARATOR  ', ' ) ) AS rating_id, CONCAT( GROUP_CONCAT( user_rating.rating_number
			ORDER BY user_rating.rating_number
			SEPARATOR  ', ' ) ) rating, user_wish_rides.date
			FROM user_wish_rides
			JOIN user ON  user.user_id =  user_wish_rides.user_id 
			LEFT JOIN user_rating ON user_rating.user_id = user_wish_rides.user_id
			LEFT JOIN user_media ON user_media.user_id = user_wish_rides.user_id
			WHERE user_wish_rides.date =  '{$date}'
			OR user_media.media_description = 'Profile Image'
			GROUP BY user_wish_rides.id, user_rating.user_id
			LIMIT $start, $limit
		");
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function detail($id, $what = "user_wish_rides.id, user_wish_rides.user_id as post_user_id, user_wish_rides.user_id as post_user_id, user.user_id AS user_id, firstname, lastname, last_login, user_wish_rides.route_from AS origin, user_wish_rides.route_to AS destination, via, storage, preference, available, user_wish_rides.start_time, user_wish_rides.date, user_car.car_model AS car, user_car.license_plate AS plate, remarks, user_media.media_filename AS image, CONCAT( GROUP_CONCAT(user_rating.rating_number) ) AS rating, user_rating.user_id as rating_id, CONCAT( GROUP_CONCAT( user_rating.rating_number ) ) AS rating") {
		$query = $this->db->select($what)
							->from('user_wish_rides')
							->join('user', 'user.user_id = user_wish_rides.user_id')
							->join('user_sessions', 'user_sessions.user_id =  user.user_id')
							->join('user_car', 'user_car.user_id = user_wish_rides.user_id', 'left')
							->join('lift_seat_booked', 'lift_seat_booked.post_id = user_wish_rides.id', 'left')
							->join('user_media', 'user_media.user_id = user_wish_rides.user_id', 'left')
							->join('user_rating', 'user_rating.user_id = user.user_id', 'left')
							->where('user_wish_rides.id', $id)
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function preference($id, $what = 'type') {
		$query = $this->db->select($what)
							->from('lift_preference')
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}	
	
	function get_user_lift_dates($user_id) {
		$query = $this->db->query("
			SELECT CONCAT( GROUP_CONCAT( id ) ) as id, CONCAT( GROUP_CONCAT( route_from SEPARATOR  '-' ) ) AS origins, CONCAT( GROUP_CONCAT( route_to SEPARATOR '-' ) ) AS destination, CONCAT( GROUP_CONCAT( DATE ) ) AS dates
			FROM user_wish_rides
			WHERE user_id = {$user_id}
			GROUP BY user_id
		");
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function get_user_lift_post($what = 'user_id, route_from as origins, route_to as destination, date as dates') {
		$id = $this->session->userdata('user_id');
		
		$query = $this->db->select($what)
							->from('user_lift_dates')
							->where('user_id', $id)
							->group_by('post_id')
							->get();
							
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function get_selected_lift($id, $what = 'user_lift_dates.date as dates') {	
		$query = $this->db->select($what)
							->from('user_lift_dates')
							->where('user_id', $id)
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function dates($post, $what = 'user_wish_date_booked.post_id, user_wish_date_booked.route_from as origins, user_wish_date_booked.route_to as destination, user_wish_date_booked.date as dates') {			
		$query = $this->db->select($what)
					->from('user_wish_date_booked')
					->where('post_id', $post)
					->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function get_user_info($id, $what = 'user_id, firstname, lastname, email') {
		$query = $this->db->select($what)
							->from('user')
							->where('user_id', $id)
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function send() {
		$data = array(
			'sender_id'		=> $this->session->userdata('user_id'),
			'receiver_id'	=> $this->input->post('user_id'),
			'subject'		=> $this->input->post('subject'),
			'message'		=> $this->input->post('message'),
			'date'			=> date('Y-m-d H:i:s')
		);
		
		$this->db->insert('message', $data);
	}
	
	public function invite_me() {
		$data = array(
			'post_id'	=> $this->input->post('post_id'),
			'user_id'	=> $this->session->userdata('user_id'),
			'dates'		=> $this->input->post('dates'),
			'price'		=> $this->input->post('price'),
			'remarks'	=> $this->input->post('remarks')
		);
		
		$this->db->insert('user_wish_invite', $data);
	}
	
	function create_wish_ride() {
		$date = explode(',', $this->input->post('dates'));
		$preference_array = implode(',', $this->input->post('preference'));
				
		foreach($date as $row):
			$expiry_date = date('Y-m-d', strtotime($row.' + 1 day'));
			
			$post_data = array(
				'user_id'		=> $this->session->userdata('user_id'),
				'route_from'	=> $this->input->post('origin'),
				'route_to'		=> $this->input->post('destination'),
				'via'			=> $this->input->post('via'),
				'available'		=> $this->input->post('seat'),
				'storage'		=> $this->input->post('storage'),
				'preference'	=> $preference_array,
				'remarks'		=> $this->input->post('remarks'),
				're_route'		=> $this->input->post('re_route'),
				'offer_re_route'=> $this->input->post('re_route'),
				'start_time'	=> $this->input->post('hours').':'.$this->input->post('minute').':00',
				'date'			=> str_replace("&quot;", "", $row),
				'expiry_date'	=> $expiry_date.' '.$this->input->post('hours').':'.$this->input->post('minute').':00',
			);
			
			$this->db->insert('user_wish_rides', $post_data);
		endforeach;
		
		if($this->input->post('re_origin') != ''):
			($this->input->post('re_dates') == '') ? $re_date = '' : $re_date = explode(',', $this->input->post('re_dates'));		
			($this->input->post('re_preference') == '') ? $re_preference_array = '' : $re_preference_array = implode(',', $this->input->post('re_preference'));
			
			foreach($re_date as $row):
				$re_expiry_date = date('Y-m-d', strtotime($row.' + 1 day'));
				
				$re_post_data = array(
					'user_id'		=> $this->session->userdata('user_id'),
					'route_from'	=> $this->input->post('re_origin'),
					'route_to'		=> $this->input->post('re_destination'),
					'via'			=> $this->input->post('re_via'),
					'available'		=> $this->input->post('re_seat'),
					'storage'		=> $this->input->post('re_storage'),
					'preference'	=> $re_preference_array,
					'remarks'		=> $this->input->post('re_remarks'),
					'start_time'	=> $this->input->post('re_hours').':'.$this->input->post('re_minute').':00',
					'date'			=> str_replace("&quot;", "", $row),
					'expiry_date'	=> $re_expiry_date.' '.$this->input->post('re_hours').':'.$this->input->post('re_minute').':00',
				);
				
				$this->db->insert('user_wish_ride_return_post', $re_post_data);
			endforeach;
		endif;
	}
	
	function passenger_count($what = 'COUNT(id) as passenger') {
		$today 		= getdate();
		$get_date 	= $today['year'].'-'.$today['mon'].'-'.$today['mday'];
		$date 		= date('Y-m-d', strtotime($get_date));
		
		$query = $this->db->select($what)
							->from('user_wish_rides')
							->where('user_wish_rides.date', $date)
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
}