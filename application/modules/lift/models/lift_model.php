<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lift_model extends CI_Model {
	
	function cities($city) {
		$query = $this->db->query("SELECT DISTINCT `combined` FROM (`user_cities`) WHERE `combined` LIKE '{$city}%'");
		
		$result = $query->result();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function search_location() {
		$from 	= mysql_real_escape_string($this->input->post('from'));
		$to 	= mysql_real_escape_string($this->input->post('to'));
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
			$where[] = "`date` Like  '{$date}'";
		endif;
		
		if(count($where)):
			$query_result = "SELECT * FROM  `user_lift_post` WHERE  ".implode(' AND ', $where);
			$query = $this->db->query($query_result);
		endif;
	
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function search_get_location($from, $to, $what = 'user_lift_post.id, user_lift_post.route_from as origin, user_lift_post.route_to as destination, available, amount, start_time, date') {		
		$from 	= mysql_real_escape_string($from);
		$to		= mysql_real_escape_string($to);
		
		$where = array();
		$query = NULL;
		
		if($from != ''):
			$where[] = "`route_from` Like '{$from}'";
		endif;
		
		if($to != ''):
			$where[] = "`route_to` Like '{$to}'";
		endif;
		
		/* if($date != ''):
			$where[] = "`date` Like '{$date}'";
		endif; */
		
		if(count($where)):
			$query_result = "SELECT {$what} FROM `user_lift_post` WHERE ".implode(' AND ', $where);
			$query = $this->db->query($query_result);
		endif;
	
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function listing($what = 'user_lift_post.id as id, user.user_id as user_id, firstname, lastname, user_lift_post.route_from as origin, user_lift_post.route_to as destination, available, user_lift_post.amount, user_lift_post.start_time, user_car.car_model as car, user_car.license_plate as plate, user_lift_post.date, lift_seat_booked.seat') {
		$query = $this->db->select($what)
							->from('user_lift_post')
							->join('user', 'user.user_id = user_lift_post.user_id')
							->join('user_car', 'user_car.user_id = user_lift_post.user_id', 'left')
							->join('lift_seat_booked', 'lift_seat_booked.post_id = user_lift_post.id', 'left')
							->group_by('user_lift_post.id')
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function seat_taken($what = "*") {
		$query = $this->db->select($what)
							->from('lift_seat_booked')
							->get();
		return $query->result();
	}
	
	function details($id, $what = "user_lift_post.id, user.user_id AS user_id, firstname, lastname, last_login, user_lift_post.route_from AS origin, user_lift_post.route_to AS destination, storage, available, user_lift_post.amount, user_lift_post.start_time, user_car.car_model AS car, user_car.license_plate AS plate, remarks, CONCAT( GROUP_CONCAT(  `user_media`.`media_filename` ) ) AS image, CONCAT( GROUP_CONCAT( lift_seat_booked.seat ) ) AS seats, CONCAT( GROUP_CONCAT(user_rating.rating_number) ) AS rating, user_lift_post.date, user_rating.user_id as rating_id, CONCAT( GROUP_CONCAT( user_rating.rating_number ) ) AS rating") {
		$query = $this->db->select($what)
							->from('user_lift_post')
							->join('user', 'user.user_id = user_lift_post.user_id')
							->join('user_sessions', 'user_sessions.user_id =  user.user_id')
							->join('user_car', 'user_car.user_id = user_lift_post.user_id', 'left')
							->join('lift_seat_booked', 'lift_seat_booked.post_id = user_lift_post.id', 'left')
							->join('user_media', 'user_media.user_id = lift_seat_booked.user_id', 'left')
							->join('user_rating', 'user_rating.user_id = user.user_id', 'left')
							->where('user_lift_post.id', $id)
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function preference($id, $what = 'post_id, CONCAT(GROUP_CONCAT(user_lift_preference.preference_id)) as preference, CONCAT(GROUP_CONCAT(lift_preference.type)) as type') {
		$query = $this->db->select($what)
							->from('user_lift_preference')
							->join('lift_preference', 'lift_preference.preference_id = user_lift_preference.preference_id')
							->where('post_id', $id)
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function book_details($post_id) {
		$query = $this->db->query("
			SELECT user_lift_post.id AS id, user.user_id AS user_id, firstname, lastname, user_lift_post.route_from AS origin, user_lift_post.route_to AS destination, available, user_lift_post.amount, user_lift_post.start_time, user_car.car_model AS car, user_car.license_plate AS plate, user_lift_post.date, 
			GROUP_CONCAT( `lift_seat_booked`.`user_id` ORDER BY `lift_seat_booked`.`user_id` SEPARATOR ', ' ) AS taken_by, 
			GROUP_CONCAT( `lift_seat_booked`.`seat` ORDER BY `lift_seat_booked`.`seat` SEPARATOR ', ' ) AS seats, 
			GROUP_CONCAT( `user_media`.`media_filename` ORDER BY `user_media`.`media_filename` SEPARATOR ', ') as image
			FROM user_lift_post
			JOIN `user` ON `user`.`user_id` = `user_lift_post`.`user_id` 
			LEFT JOIN `user_car` ON `user_car`.`user_id` = `user_lift_post`.`user_id` 
			LEFT JOIN `lift_seat_booked` ON `lift_seat_booked`.`post_id` = `user_lift_post`.`id` 
			LEFT JOIN `user_media` ON `user_media`.`user_id` = `lift_seat_booked`.`user_id` 
			WHERE `user_lift_post`.`id` = '{$post_id}'
		");
		
		return $query->result_array();
	}
	
	function booked($user_id, $post_id, $seat_taken, $amount, $message, $request, $start_time, $date) {
		$data = array(
			'user_id' 			=> $user_id,
			'post_id' 			=> $post_id,
			'amount' 			=> $amount,
			'message' 			=> $message,
			'request' 			=> $request,
			'booking_status'	=> 'Pending',
			'start_time'		=> $start_time,
			'date' 				=> $date
		);
		
		$booked		= $this->db->insert('lift_booked', $data);
		
		for($i = 0; $i < $seat_taken; $i++):
			$data = array(
				'post_id' 	=> $post_id,
				'user_id' 	=> $user_id,
				'seat'		=> '1'
			);			
			
			$this->db->insert('lift_seat_booked', $data);
		endfor;
	}
	
	public function create_lift() {
		$post_data = array(
			'user_id'		=> $this->session->userdata('user_id'),
			'route_from'	=> $this->input->post('origin'),
			'route_to'		=> $this->input->post('destination'),
			'via'			=> $this->input->post('via'),
			'available'		=> $this->input->post('seat_available'),
			'storage'		=> $this->input->post('storage'),
			'remarks'		=> $this->input->post('remarks'),
			'amount'		=> $this->input->post('seat_amount'),
			're_route'		=> $this->input->post('re_route'),
			'offer_re_route'=> $this->input->post('re_route'),
			'start_time'	=> $this->input->post('hours').':'.$this->input->post('minute').':00',
			'date'			=> str_replace("&quot;", "\"", $this->input->post('dates'))
		);
		
		$insert_post = $this->db->insert('user_lift_post', $post_data);

		$preference_array = array();
		
		for($i = 0; $i < count($this->input->post('preference')); $i++):
			// $preference_array[] =  $i;
			
			$preference_data = array(
				'post_id' => $this->session->userdata('user_id'),
				'preference_id' => $i+1
			);
			
			$insert_preference = $this->db->insert('user_lift_preference', $preference_data);
		endfor;
	}

	public function get_user_car($user_id) {
		$query = $this->db->get_where('user_car', array('user_id'=> $user_id));
		
		$result = $query->result();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function insert_rating($user_id, $rating_number) {
		$data = array(
			'user_id' => $user_id,
			'rating_number' => $rating_number
		);
		$this->db->insert('user_rating', $data);
	}
}