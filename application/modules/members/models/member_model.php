<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_model extends CI_Model {
	
	public function members($user_id, $what = 'firstname, lastname, email, city, country, user_media.media_filename as image, number, user_car.car_model as car, user_car.license_plate as plate, last_login, user.date, COUNT(user_lift_post.user_id) as created') {
		$query = $this->db->select($what)
							->from('user')
							->join('user_address', 'user_address.user_id = user.user_id', 'left')
							->join('user_sessions', 'user_sessions.user_id = user.user_id', 'left')
							->join('user_media', 'user_media.user_id = user.user_id', 'left')
							->join('user_mobile', 'user_mobile.user_id = user.user_id', 'left')
							->join('user_car', 'user_car.user_id = user.user_id', 'left')
							->join('user_lift_post', 'user_lift_post.user_id = user.user_id', 'left')
							->where('user.user_id', $user_id)
							->get();

		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function member_information($user_id, $what = 'firstname, lastname, about_me, job, birthdate, street, city, country, postal, user_media.media_filename as image, number, phone') {
		$query = $this->db->select($what)
							->from('user')
							->join('user_additional_information', 'user_additional_information.user_id = user.user_id', 'left')
							->join('user_address', 'user_address.user_id = user.user_id', 'left')
							->join('user_media', 'user_media.user_id = user.user_id', 'left')
							->join('user_mobile', 'user_mobile.user_id = user.user_id', 'left')
							->where('user.user_id', $user_id)
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function rides_list($what = 'user_lift_post.id, user_lift_post.route_from as origins, user_lift_post.route_to as destination, user_lift_post.start_time as time, user_lift_dates.date') {
		$id = $this->session->userdata('user_id');
		
		$query = $this->db->select($what)
							->from('user_lift_post', 'user_lift_post.user_id = user.user_id')
							->join('user', 'user.user_id = user_lift_post.user_id')
							->join('user_lift_dates', 'user_lift_dates.user_id = user_lift_post.user_id')
							->where('user_lift_post.user_id', $id)
							->get();
							
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function ride_detail($id, $what = 'user_lift_post.route_from as origins, user_lift_post.route_to as destination, via, available, storage, remarks, amount, re_route, offer_re_route, start_time') {
		$query = $this->db->select($what)
							->from('user_lift_post')
							->join('user_lift_dates', 'user_lift_dates.user_id = user_lift_post.user_id')
							->where('user_lift_post.id', $id)
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function passenger_list($what = 'user_wish_lift.id, user_wish_lift.route_from as origins, user_wish_lift.route_to as destination, time') {
		$id = $this->session->userdata('user_id');
		
		$query = $this->db->select($what)
							->from('user_wish_lift', 'user_wish_lift.user_id = user.user_id')
							->join('user', 'user.user_id = user_wish_lift.user_id')
							->where('user_wish_lift.user_id', $id)
							->get();
							
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function inbox($what = 'message_id, subject, message, date') {
		$id = $this->session->userdata('user_id');
		
		$query = $this->db->select($what)
							->from('message')
							->where('receiver_id', $id)
							->get();
				
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function inbox_detail($id, $what = 'message_id, firstname, lastname, media_filename as image, subject, message, message.date') {
		$query = $this->db->select($what)
							->from('message')
							->where('message_id', $id)
							->join('user', 'user.user_id = message.sender_id')
							->join('user_media', 'user_media.user_id = user.user_id')
							->get();
				
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function sent($what = 'message_id, subject, message, date') {
		$id = $this->session->userdata('user_id');
		
		$query = $this->db->select($what)
							->from('message')
							->where('sender_id', $id)
							->get();
				
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function sent_detail($id, $what = 'message_id, firstname, lastname, media_filename as image, subject, message, message.date') {
		$query = $this->db->select($what)
							->from('message')
							->join('user', 'user.user_id = message.receiver_id')
							->join('user_media', 'user_media.user_id = user.user_id', 'left')
							->where('message_id', $id)
							->get();
				
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function inbox_delete() {
		$id = $this->input->post('id');
		
		foreach($id as $row):
			$this->db->where_in('message_id', $row)->delete('message');
		endforeach;
	}

	public function message_delete($id) {
		$this->db->where_in('message_id', $id)->delete('message');
		
		redirect('members/inbox');
	}
	
	public function countries($what = '*') {
		$query = $this->db->get_where('countries', array('continent_code' => 'EU'));
		
		return $query->result();
	}
	
	public function update($user_id) {
		$location	= explode(',', $this->input->post('city_country'));
	
		$about_me 	= $this->input->post('about_me');
		$firstname 	= $this->input->post('firstname');
		$lastname 	= $this->input->post('lastname');
		$job 		= $this->input->post('work');
		$address_no = $this->input->post('address_no');
		$street 	= $this->input->post('street');
		$postal 	= $this->input->post('postal');
		$city 		= $location[0];
		$country 	= $location[1];
		$mobile 	= $this->input->post('mobile');
		$phone 		= $this->input->post('phone');
	
		$this->db->query("UPDATE user, user_additional_information, user_address, user_mobile 
							SET user.firstname = '{$firstname}', 
							    user.lastname = '{$lastname}',
								user_additional_information.about_me = '{$about_me}',
								user_additional_information.job = '{$job}',
								user_address.address_no = '{$address_no}', 
								user_address.street = '{$street}', 
								user_address.city = '{$city}',
								user_address.country = '{$country}',
								user_address.postal = '{$postal}',
								user_mobile.number = '{$mobile}',
								user_mobile.phone = '{$phone}'
							WHERE user.user_id AND user_additional_information.user_id AND user.user_id = user_address.user_id AND user.user_id = user_mobile.user_id  = '{$user_id}';");
		
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
	function get_location($location, $what = 'combined') {
		$query = $this->db->select($what)
							->distinct()
							->from('user_cities')
							->like('combined', $location, 'after')
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function search_location() {
		$from = $this->input->post('from');
		$to = $this->input->post('to');
		
		$query = $this->db->query("SELECT * FROM  `user_lift_booking`  WHERE  `route_from` LIKE  '{$from}' AND  `route_to` LIKE  '{$to}' AND  `date` IS NOT NULL");
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function car($id, $what = 'user_car.car_model as car, user_car.license_plate as plate, door, seat, transmission, air_condition, fuel, year') {
		$query = $this->db->select($what)
							->from('user_car')
							->where('user_id', $id)
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
}