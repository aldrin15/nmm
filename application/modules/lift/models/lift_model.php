<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lift_model extends CI_Model {
	
	function search_location($limit, $start, $what = 'user_lift_post.id, firstname, lastname, user_lift_post.route_from as origin, user_lift_post.route_to as destination, available, amount, start_time, user_lift_post.date') {
		$from 	= mysql_real_escape_string($this->input->post('from'));
		$to 	= mysql_real_escape_string($this->input->post('to'));
		$date 	= date('Y-m-d', strtotime($this->input->post('date')));
		$time 	= $this->input->post('hour').':'.$this->input->post('minute').':00';
		$price 	= $this->input->post('price');
		
		$where = array();
		$query = NULL;
		
		if($from != ''):
			$where[] = "route_from Like '{$from}'";
		endif;
		
		if($to != ''):
			$where[] = "route_to Like '{$to}'";
		endif;
		
		if($date != ''):
			$where[] = "user_lift_post.date = '{$date}'";
		endif;
		
		if($time != ''):
			$where[] = "user_lift_post.start_time = '{$time}'";
		endif;
		
		if($price != ''):
			$where[] = "amount BETWEEN {$price}";
		endif;
		
		if(count($where)):
			$query_result = "SELECT $what FROM  `user_lift_post` JOIN user ON user.user_id = user_lift_post.user_id JOIN user_media ON user_media.user_id = user_lift_post.user_id JOIN user_car ON user_car.user_id = user_lift_post.user_id WHERE  ".implode(' AND ', $where);
			$query = $this->db->query($query_result);
		endif;
	
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function search_get_location($from, $to, $date, $amount, $what = 'user_lift_post.id, firstname, lastname, user_lift_post.route_from as origin, user_lift_post.route_to as destination, available, amount, start_time, user_lift_post.date') {		
		$from 	= mysql_real_escape_string($from);
		$date 	= date('Y-m-d', strtotime($date));
		$to		= mysql_real_escape_string($to);
		$amount	= $amount;
		
		$where = array();
		$query = NULL;
		
		if($from != ''):
			$where[] = "`route_from` Like '{$from}'";
		endif;
		
		if($to != ''):
			$where[] = "`route_to` Like '{$to}'";
		endif;
		
		if($date != ''):
			$where[] = "user_lift_post.date = '{$date}'";
		endif;
		
		if($amount != ''):
			$where[] = "amount BETWEEN {$price}";
		endif;
		
		if(count($where)):
			$query_result = "SELECT $what FROM  `user_lift_post` JOIN user ON user.user_id = user_lift_post.user_id JOIN user_media ON user_media.user_id = user_lift_post.user_id JOIN user_car ON user_car.user_id = user_lift_post.user_id WHERE  ".implode(' AND ', $where);
			$query = $this->db->query($query_result);
		endif;
	
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function ride_where_count($what = 'COUNT(id) as rides') {
		$today 		= getdate();
		$get_date 	= $today['year'].'-'.$today['mon'].'-'.$today['mday'];
		$date 		= date('Y-m-d', strtotime($get_date));
		
		$from 	= $this->input->post('from');
		$to		= $this->input->post('to');
		
		$query = $this->db->select($what)
							->from('user_lift_post')
							->where(array('route_from'=>$from, 'route_to'=>$to, 'user_lift_post.date'=>$date))
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function listing($limit, $start, $what = 'user_lift_post.id as id, user.user_id as user_id, firstname, lastname, user_media.media_filename as image, user_lift_post.route_from as origin, user_lift_post.route_to as destination, available, user_lift_post.amount, user_lift_post.start_time, user_car.car_model as car, user_car.license_plate as plate, user_lift_post.date') {
		$today 		= getdate();
		$get_date 	= $today['year'].'-'.$today['mon'].'-'.$today['mday'];
		$date 		= date('Y-m-d', strtotime($get_date));
		
		$query = $this->db->select($what)
							->from('user_lift_post')
							->join('user', 'user.user_id = user_lift_post.user_id')
							->join('user_media', 'user_media.user_id = user_lift_post.user_id', 'left')
							->join('user_car', 'user_car.user_id = user_lift_post.user_id', 'left')
							->where('user_lift_post.date', $date)
							->limit($limit, $start)
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function ride_count($what = 'COUNT(id) as rides') {
		$today 		= getdate();
		$get_date 	= $today['year'].'-'.$today['mon'].'-'.$today['mday'];
		$date 		= date('Y-m-d', strtotime($get_date));
		
		$query = $this->db->select($what)
							->from('user_lift_post')
							->where('user_lift_post.date', $date)
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
	
	function details($id, $what = "user_lift_post.id, user_lift_post.user_id as post_user_id, user.user_id AS user_id, firstname, lastname, last_login, user_lift_post.route_from AS origin, user_lift_post.route_to AS destination, storage, preference, available, user_lift_post.amount, user_lift_post.start_time, user_lift_post.date, user_car.car_model AS car, user_car.license_plate AS plate, remarks, user_media.media_filename AS image, CONCAT( GROUP_CONCAT(user_rating.rating_number) ) AS rating, user_rating.user_id as rating_id, CONCAT( GROUP_CONCAT( user_rating.rating_number ) ) AS rating") {
		$query = $this->db->select($what)
							->from('user_lift_post')
							->join('user', 'user.user_id = user_lift_post.user_id')
							->join('user_sessions', 'user_sessions.user_id =  user.user_id')
							->join('user_car', 'user_car.user_id = user_lift_post.user_id', 'left')
							->join('lift_seat_booked', 'lift_seat_booked.post_id = user_lift_post.id', 'left')
							->join('user_media', 'user_media.user_id = user_lift_post.user_id', 'left')
							->join('user_rating', 'user_rating.user_id = user.user_id', 'left')
							->where('user_lift_post.id', $id)
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
			FROM user_lift_post
			WHERE user_id = {$user_id}
			GROUP BY user_id
		");
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function get_lift_post($id, $what = 'user_lift_post.id, user_lift_post.route_from as origins, user_lift_post.route_to as destination, user_lift_post.via, user_lift_post.available, user_lift_post.amount, user_lift_post.re_route, user_lift_post.start_time as time, CONCAT( GROUP_CONCAT( lift_seat_booked.seat ) ) as seat') {
		$query = $this->db->select($what)
							->from('user_lift_post')
							->join('user', 'user.user_id = user_lift_post.user_id')
							->join('lift_seat_booked', 'lift_seat_booked.post_id = user_lift_post.id', 'left')
							->where('user_lift_post.id', $id)
							->get();
							
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function booked_by($id, $what = 'user.user_id, user_media.media_filename as image') {
		$query = $this->db->select($what)
							->from('lift_seat_booked')
							->join('user', 'user.user_id = lift_seat_booked.user_id')
							->join('user_media', 'user_media.user_id = user.user_id', 'left')
							->where('lift_seat_booked.post_id', $id)
							->get();
							
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function lift_seat_booked($id, $date, $what = 'lift_seat_booked.seat as seats, lift_seat_booked.date, media_filename as image') {	
		$array = array('post_id' => $id, 'date' => date('Y-m-d', strtotime($date)));
		
		$query = $this->db->select($what)
							->from('lift_seat_booked')
							->join('user_media', 'user_media.user_id = lift_seat_booked.user_id')
							->where($array)
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function get_user_image($what = 'media_filename as image') {
		$query = $this->db->select($what)
							->from('user_media')
							->where('user_id', $this->session->userdata('user_id'))
							->get();
							
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function booked_user() {
		for($i = 0; $i < $this->input->post('get_seat'); $i++):
			$data = array(
				'post_id'		=> $this->input->post('id'),
				'user_id'		=> $this->session->userdata('user_id'),
				'seat'			=> '1',
				'reroute_from'	=> $this->input->post('reroute_from'),
				'reroute_to'	=> $this->input->post('reroute_to'),
				'co2'   		=> $this->input->post('co2'),
				'date'			=> date('Y-m-d', strtotime($this->input->post('date')))
			);
			
			$query = $this->db->insert('lift_seat_booked', $data);
		endfor;
	}
	
	function book_details($post_id) {
		$query = $this->db->query("
			SELECT user_lift_post.id AS id, user.user_id AS user_id, firstname, lastname, user_lift_post.route_from AS origin, user_lift_post.route_to AS destination, available, user_lift_post.amount, user_lift_post.start_time, user_car.car_model AS car, user_car.license_plate AS plate, 
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
	
	function create_lift() {
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
				'amount'		=> $this->input->post('seat_amount'),
				're_route'		=> $this->input->post('re_route'),
				'offer_re_route'=> $this->input->post('re_route'),
				'start_time'	=> $this->input->post('hours').':'.$this->input->post('minute').':00',
				'date'			=> str_replace("&quot;", "", $row),
				'expiry_date'	=> $expiry_date.' '.$this->input->post('hours').':'.$this->input->post('minute').':00',
			);
			
			$this->db->insert('user_lift_post', $post_data);
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
					'amount'		=> $this->input->post('re_amount'),
					'start_time'	=> $this->input->post('re_hours').':'.$this->input->post('re_minute').':00',
					'date'			=> str_replace("&quot;", "", $row),
					'expiry_date'	=> $re_expiry_date.' '.$this->input->post('re_hours').':'.$this->input->post('re_minute').':00',
				);
				
				$this->db->insert('user_lift_return_post', $re_post_data);
			endforeach;
		endif;
	}
	
	function get_wish($id, $what = 'user_wish_lift.route_from AS origin, user_wish_lift.route_to AS destination, via, time, CONCAT( GROUP_CONCAT( user_wish_lift_preference.preference_id ) ) AS preference_id, CONCAT( GROUP_CONCAT( type ) ) as type') {
		$query = $this->db->select($what)
							->from('user_wish_lift')
							->join('user_wish_lift_preference', 'user_wish_lift_preference.post_id = user_wish_lift.id', 'left')
							->join('lift_preference', 'lift_preference.preference_id = user_wish_lift_preference.preference_id')
							->where('user_wish_lift.id', $id)
							->group_by('user_wish_lift_preference.post_id')
							->get();
							
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function get_wish_date($id, $what = 'date') {
		$query = $this->db->select($what)
							->from('user_wish_date_booked')
							->where('post_id', $id)
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}

	function get_user_car($id) {
		$query = $this->db->get_where('user_car', array('user_id'=> $id));
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function insert_rating($user_id, $rating_number) {
		$data = array(
			'user_id' => $user_id,
			'rating_number' => $rating_number
		);
		$this->db->insert('user_rating', $data);
	}
	
	function rides($what = 'COUNT(id) as rides') {
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
	
	function expired_post() {
		$date = date('Y-m-d H:i:s');
		
		$query = $this->db->select('*')
							->from('user_lift_post')
							->where('expiry_date <=', $date)
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return False;
		return $result;
	}
	
	function featured_ride($what = 'user_lift_post.id, firstname, lastname, media_filename as image') {
		$query = $this->db->select($what)
							->from('user_lift_post')
							->join('user', 'user.user_id = user_lift_post.user_id')
							->join('user_car', 'user_car.user_id = user.user_id', 'left')
							->join('user_media', 'user_media.user_id = user.user_id', 'left')
							->where('user_media.media_name', 'Profile Image')
							->where('user_lift_post.date >= NOW() - INTERVAL 1 DAY', '', false)
							->limit(4)
							->order_by('user_lift_post.id', 'desc')
							->get();
							
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function get_co2_daily($date, $what = 'co2'){
		$query  = $this->db->select_sum($what)
							->from('user_lift_post')
							->join('lift_seat_booked', 'lift_seat_booked.post_id = user_lift_post.id')
							->where('user_lift_post.date', $date)
							->get();
		
		$result = $query->result();
		if(count($result) == 0) return FALSE;
		return $result;
	}
}