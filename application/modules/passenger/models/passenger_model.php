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
		/* $query = $this->db->select($what)
							->from('user_wish_lift')
							->join('user', 'user.user_id = user_wish_lift.user_id')
							->join('user_rating', 'user_rating.user_id = user.user_id', 'left')
							->get(); */
		$query = $this->db->query("
			SELECT user_wish_lift.user_id, firstname, lastname, via, user_wish_lift.date_created AS posted, TIME, available, route_from AS origin, route_to AS destination, CONCAT( GROUP_CONCAT( user_rating.user_id
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