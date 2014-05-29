<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lift_model extends CI_Model {
	
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
			$where[] = "`date` Like  '{$date}'";
		endif;
		
		if(count($where)):
			$query_result = "SELECT * FROM  `user_lift_booking` WHERE  ".implode(' AND ', $where);
			$query = $this->db->query($query_result);
		endif;
	
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function search_get_location() {
		$from 	= $this->input->get('from');
		$to 	= $this->input->get('to');
		$date 	= $this->input->get('date');
		
		$where = array();
		$query = NULL;
		
		if($from != ''):
			$where[] = "`route_from` Like '{$from}'";
		endif;
		
		if($to != ''):
			$where[] = "`route_to` Like '{$to}'";
		endif;
		
		if($date != ''):
			$where[] = "`date` Like '{$date}'";
		endif;
		
		if(count($where)):
			$query_result = "SELECT * FROM `user_lift_booking` WHERE ".implode(' AND ', $where);
			$query = $this->db->query($query_result);
		endif;
	
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function listing($what = 'user_lift_post.user_id as id, user_lift_post.route_from as origin, user_lift_post.route_to as destination, available, amount, quick_book, start_time, user_car.car_model as car, user_car.license_plate as plate, date') {
		$query = $this->db->select($what)
							->from('user_lift_post')
							->join('user_car', 'user_car.user_id = user_lift_post.user_id')
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function details($id) {
		$query = $this->db->query("
			SELECT user.user_id AS id, firstname, lastname, user_lift_post.route_from AS origin, user_lift_post.route_to AS destination, 
			storage, user_car.car_model AS car, user_car.license_plate AS plate, available, amount, start_time, user_lift_post.date, 
			GROUP_CONCAT( user_lift_preference.preference_id ORDER BY user_lift_preference.preference_id SEPARATOR  ', ' ) AS p_id,
			GROUP_CONCAT( lift_preference.type ORDER BY lift_preference.preference_id SEPARATOR  ', ' ) AS TYPE
			FROM (
			 `user`
			)
			JOIN  `user_lift_post` ON  `user_lift_post`.`user_id` =  `user`.`user_id` 
			JOIN  `user_car` ON  `user_car`.`user_id` =  `user`.`user_id` 
			JOIN  `user_lift_preference` ON  `user_lift_preference`.`post_id` =  `user_lift_post`.`id`
			JOIN  `lift_preference` ON `lift_preference`.`preference_id` = `user_lift_preference`.`preference_id`
			WHERE  `user`.`user_id` = {$id}		
		");
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function booking($user_id, $from, $to, $car_model, $plate, $seat_taken, $amount, $message, $request, $start_time, $end_time, $date) {	
		$data = array(
			'user_id' 			=> $user_id,
			'route_from' 		=> $from,
			'route_to' 			=> $to,
			'car_model' 		=> $car_model,
			'license_plate' 	=> $plate,
			'seat_taken' 		=> $seat_taken,
			'amount' 			=> $amount,
			'message' 			=> $message,
			'request' 			=> $request,
			'booking_status'	=> 'Pending',
			'start_time'		=> $start_time,
			'end_time'			=> $end_time,
			'date' 				=> $date
		);
		
		$query = $this->db->insert('user_passenger_booking', $data);
	}
}