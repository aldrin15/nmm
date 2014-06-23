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
	
	function listing() {
		$query = $this->db->query("
			SELECT user_wish_lift.id, user_wish_lift.user_id, firstname, lastname, via, user_wish_lift.date_created AS posted, TIME, available, route_from AS origin, route_to AS destination, CONCAT( GROUP_CONCAT( user_rating.user_id
			ORDER BY user_rating.user_id
			SEPARATOR  ', ' ) ) AS rating_id, CONCAT( GROUP_CONCAT( user_rating.rating_number
			ORDER BY user_rating.rating_number
			SEPARATOR  ', ' ) ) rating
			FROM user_wish_lift
			JOIN  `user` ON  `user`.`user_id` =  `user_wish_lift`.`user_id` 
			LEFT JOIN user_rating ON user_rating.user_id = user_wish_lift.user_id
			GROUP BY user_wish_lift.id, user_rating.user_id	
		");
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function detail($id, $what = "user_wish_lift.id, user_wish_lift.user_id, firstname, lastname, user_media.media_filename as image, user_wish_lift.route_from as origin, user_wish_lift.route_to as destination, storage, available, remarks, user_wish_lift.time, last_login, CONCAT( GROUP_CONCAT( user_rating.user_id ) ) AS rating_id, CONCAT( GROUP_CONCAT( user_rating.rating_number ) ) rating, CONCAT( GROUP_CONCAT( DISTINCT user_wish_lift_preference.preference_id ) ) as p_id, CONCAT( GROUP_CONCAT( DISTINCT lift_preference.type ) ) as type, CONCAT( GROUP_CONCAT( user_wish_date_booked.route_from ) ) AS other_post_origins, CONCAT( GROUP_CONCAT( user_wish_date_booked.route_to ) ) AS other_post_destinations, CONCAT( GROUP_CONCAT( DISTINCT user_wish_date_booked.date ) ) AS other_post_dates") {
		$query = $this->db->select($what)
							->from('user_wish_lift')
							->join('user', 'user.user_id = user_wish_lift.user_id')
							->join('user_sessions', 'user_sessions.user_id = user_wish_lift.user_id')
							->join('user_media', 'user_media.user_id = user_wish_lift.user_id')
							->join('user_wish_date_booked', 'user_wish_date_booked.post_id = user_wish_lift.id', 'left')
							->join('user_wish_lift_preference', 'user_wish_lift_preference.post_id = user_wish_lift.id', 'left')
							->join('lift_preference', 'lift_preference.preference_id = user_wish_lift_preference.preference_id', 'left')
							->join('user_rating', 'user_rating.user_id = user.user_id', 'left')
							->where('user_wish_lift.id', $id)
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function preference($id, $what = 'post_id, CONCAT(GROUP_CONCAT(user_wish_lift_preference.preference_id)) as preference, CONCAT(GROUP_CONCAT(lift_preference.type)) as type') {
		$query = $this->db->select($what)
							->from('user_wish_lift_preference')
							->join('lift_preference', 'lift_preference.preference_id = user_wish_lift_preference.preference_id')
							->where('post_id', $id)
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function dates($id, $what = 'user_wish_date_booked.date') {	
		$query = $this->db->select($what)
					->from('user_wish_date_booked')
					->where('post_id', $id)
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
	
	public function create_wish_lift() {
		$post_data = array(
			'user_id'		=> $this->session->userdata('user_id'),
			'route_from'	=> $this->input->post('origin'),
			'route_to'		=> $this->input->post('destination'),
			'via'			=> $this->input->post('via'),
			'date'			=> str_replace("&quot;", "\"", $this->input->post('dates')),
			'time'			=> $this->input->post('hours').':'.$this->input->post('minute').':00',
			'available'		=> $this->input->post('seat_available'),
			'storage'		=> $this->input->post('storage'),
			'remarks'		=> $this->input->post('remarks'),
			'payment'		=> $this->input->post('payment'),
			're_route'		=> $this->input->post('re_route'),
			'date_created'	=> date('Y-m-d')
		);
		
		$insert_post = $this->db->insert('user_wish_lift', $post_data);
		
		$preference_array = array();
		
		for($i = 1; $i < count($this->input->post('preference'))+1; $i++):
			// $preference_array[] =  $i;
			
			$preference_data = array(
				'post_id' => $this->session->userdata('user_id'),
				'preference_id' => $i
			);
			
			$insert_preference = $this->db->insert('user_wish_lift_preference', $preference_data);
		endfor;
	}
}