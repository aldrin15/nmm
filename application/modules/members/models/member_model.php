<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_model extends CI_Model {
	
	public function members($user_id, $what = '*') {
		$query = $this->db->select($what)
							->from('user')
							->join('user_address', 'user_address.user_id = user.user_id')
							->join('user_mobile', 'user_mobile.user_id = user.user_id')
							->join('user_car', 'user_car.user_id = user.user_id')
							->where('user.user_id', $user_id)
							->get();

		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function countries($what = '*') {
		$query = $this->db->get_where('countries', array('continent_code' => 'EU'));
		
		return $query->result();
	}
	
	public function update($user_id) {
		$about_me 	= $this->input->post('about_me');
		$firstname 	= $this->input->post('firstname');
		$lastname 	= $this->input->post('lastname');
		$job 		= $this->input->post('job');
		$address_no = $this->input->post('address_no');
		$street 	= $this->input->post('street');
		$postal 	= $this->input->post('postal');
		$city 		= $this->input->post('city');
		$country 	= $this->input->post('country');
		$mobile 	= $this->input->post('mobile');
	
		$this->db->query("UPDATE user, user_address, user_mobile 
							SET user.firstname = '{$firstname}', 
							    user.lastname = '{$lastname}', 
								user_address.address_no = '{$address_no}', 
								user_address.street = '{$street}', 
								user_address.city = '{$city}',
								user_address.country = '{$country}',
								user_address.postal = '{$postal}',
								user_mobile.number = '{$mobile}'
							WHERE user.user_id = user_address.user_id AND user.user_id = user_mobile.user_id AND user.user_id = '{$user_id}';");
		return true;
	}
	
	public function update_media($user_id, $image_data) {
		$data = array(
			'media_filename' => $image_data['file_name'],
			'media_type' => $image_data['image_type'],
			'media_description' => 'Profile Image'
		);
		
		$this->db->update('user_media', $data, array('user_id' => $user_id));
		
		return true;
	}
	
	public function update_settings($user_id) {
		$data = array(
			'email'		=> $this->input->post('email'),
			'password'	=> md5($this->input->post('password'))
		);
		
		$this->db->update('user', $data, array('user_id' => $user_id));
	}
	
	/*****
	 * Populate City by Country
	 *****/
	function get_city($country_code) {
		$query = $this->db->get_where('user_cities', array('country_code' => $country_code));

		return $query->result();
	}
	
	public function search_location() {
		$from = $this->input->post('from');
		$to = $this->input->post('to');
		
		// SELECT * FROM  `user_lift_booking` WHERE  `route_from` LIKE  'Aixirivali, Andorra' AND  `route_to` LIKE  'Arans, Andorra' 
		$query = $this->db->query("SELECT * FROM  `user_lift_booking`  WHERE  `route_from` LIKE  '{$from}' AND  `route_to` LIKE  '{$to}' AND  `date` IS NOT NULL");
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function create_lift() {
		$post_data = array(
			'user_id'		=> $this->session->userdata('user_id'),
			'route_from'	=> $this->input->post('origin'),
			'route_to'		=> $this->input->post('destination'),
			'available'		=> $this->input->post('seat_available'),
			'storage'		=> $this->input->post('storage'),
			'remarks'		=> $this->input->post('remarks'),
			'amount'		=> $this->input->post('seat_amount'),
			'accept_cash'	=> $this->input->post('accept_cash'),
			're_route'		=> $this->input->post('re_route'),
			'quick_book'	=> $this->input->post('quick_book'),
			'start_time'	=> $this->input->post('hours').':'.$this->input->post('minute').':00',
			'date'			=> str_replace("&quot;", "\"", $this->input->post('dates'))
		);
		
		// $insert_post = $this->db->insert('user_lift_post', $post_data);
		
		$preference_array = array();
		
		for($i = 1; $i < count($this->input->post('preference')); $i++):
			// $preference_array[] =  $i;
			
			$preference_data = array(
				'user_id' => $this->session->userdata('user_id'),
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
}