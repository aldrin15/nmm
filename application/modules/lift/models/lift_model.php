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
		$query = $this->db->select($what)->from('user_lift_booking')->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function details($id) {
		$query = $this->db->get_where('user_lift_booking', array('id' => $id));
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function booking($user_id, $from, $to, $seat_taken, $amount, $message, $request, $date) {	
		$data = array(
			'user_id' 			=> $user_id,
			'route_from' 		=> $from,
			'route_to' 			=> $to,
			'seat_taken' 		=> $seat_taken,
			'amount' 			=> $amount,
			'message' 			=> $message,
			'request' 			=> $request,
			'booking_status'	=> 'Pending',
			'date' 				=> $date
		);
		
		$query = $this->db->insert('user_passenger_booking', $data);
	}
}