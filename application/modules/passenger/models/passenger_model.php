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
	
	function listing($what = 'firstname, lastname, user_wish_lift.route_from as origin, user_wish_lift.route_to as destination, available, user_wish_lift.date_created as posted') {
		$query = $this->db->select($what)
							->from('user_wish_lift')
							->join('user', 'user.user_id = user_wish_lift.user_id')
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
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