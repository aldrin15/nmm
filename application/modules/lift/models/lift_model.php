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
	
	function listing($what = '*') {
		$query = $this->db->select($what)->from('user_lift_post')->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function details($id) {
		$query = $this->db->query("
			SELECT user_lift.lift_post_id AS id, user_lift_post.route_from AS origin, user_lift_post.route_to AS destination, available, user_lift_post.car_model as car, user_lift_post.license_plate as plate, storage, amount, start_time, end_time, date, GROUP_CONCAT( lift_preference.type ORDER BY lift_preference.type SEPARATOR  ', ' ) AS type, GROUP_CONCAT( lift_preference.preference_id ORDER BY lift_preference.preference_id SEPARATOR  ', ' ) AS p_id 
			FROM (`user_lift`)
			JOIN  `user_lift_post` ON  `user_lift_post`.`user_id` =  `user_lift`.`lift_post_id` 
			JOIN  `lift_preference` ON  `lift_preference`.`preference_id` =  `user_lift`.`preference_id` 
			WHERE  `lift_post_id` IN ('{$id}')
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