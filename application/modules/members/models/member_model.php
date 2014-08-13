<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_model extends CI_Model {
	
	public function billing_validate($what = 'account_status') {
		$query = $this->db->select($what)
							->from('user')
							->where('user_id', $this->session->userdata('user_id'))
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return false;
		return $result;
	}
	
	public function members($user_id, $what = 'firstname, lastname, email, about_me, birthdate, job, city, country, user_media.media_filename as image, number, user_car.car_model as car, user_car.license_plate as plate, last_login, user.date, COUNT(user_lift_post.user_id) as created') {
		$query = $this->db->select($what)
							->from('user')
							->join('user_address', 'user_address.user_id = user.user_id', 'left')
							->join('user_additional_information', 'user_additional_information.user_id = user.user_id', 'left')
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
	
	public function member_information($user_id, $what = 'firstname, lastname, about_me, job, birthdate, street, city_country, postal, number, phone') {
		$query = $this->db->select($what)
							->from('user')
							->join('user_additional_information', 'user_additional_information.user_id = user.user_id', 'left')
							->join('user_address', 'user_address.user_id = user.user_id', 'left')
							->join('user_mobile', 'user_mobile.user_id = user.user_id', 'left')
							->where('user.user_id', $user_id)
							->get();
							
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function member_profile_image($id, $what = 'user_media.media_filename as image') {
		$query = $this->db->select($what)
							->from('user_media')
							->where('user_id', $id)
							->where('user_media.media_description', 'Profile Image')
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function get_profile($id, $what = 'firstname, lastname, job, birthdate, media_filename as image, city, country, car_model as car, COUNT(user_lift_post.user_id) as created_rides, last_login, user.date as date_registered') {
		$query = $this->db->select($what)
							->from('user')
							->join('user_address', 'user_address.user_id = user.user_id', 'left')
							->join('user_additional_information', 'user_additional_information.user_id = user.user_id', 'left')
							->join('user_sessions', 'user_sessions.user_id = user.user_id')
							->join('user_media', 'user_media.user_id = user.user_id', 'left')
							->join('user_car', 'user_car.user_id = user.user_id', 'left')
							->join('user_lift_post', 'user_lift_post.user_id = user.user_id', 'left')
							->where('user.user_id', $id)
							->get();
							
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function rides_list($id, $what = '') {
		if($this->session->userdata('validated') == false):
			$id = $id;
		else:
			$id = $this->session->userdata('user_id');
		endif;
		
		$query = $this->db->select('user_lift_post.id, user_lift_post.id, user_lift_post.route_from as origins, user_lift_post.route_to as destination, user_lift_post.start_time as time, user_lift_post.date')
							->from('user_lift_post')
							->join('user', 'user.user_id = user_lift_post.user_id')
							->where('user_lift_post.user_id', $id)
							->order_by('user_lift_post.date', 'asc')
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function ride_detail($id, $what = 'user_lift_post.route_from as origins, user_lift_post.route_to as destination, via, available, storage, preference, remarks, amount, re_route, offer_re_route, start_time') {
		$query = $this->db->select($what)
							->from('user_lift_post')
							->where('user_lift_post.id', $id)
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function ride_update($id){
		$preference_array = implode(',', $this->input->post('preference'));
		
		$data = array(
			'start_time' => $this->input->post('hour').':'.$this->input->post('minute').":00",
			'storage' => $this->input->post('storage'),
			'preference' => $preference_array
		);
		
		$this->db->update('user_lift_post', $data, array('id'=>$id));
	}
	
	function preference($id, $what = 'type') {
		$query = $this->db->select($what)
							->from('lift_preference')
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function passenger_detail($id, $what = 'user_wish_rides.route_from as origins, user_wish_rides.route_to as destination, via, available, storage, preference, remarks, re_route, offer_re_route, start_time') {
		$query = $this->db->select($what)
							->from('user_wish_rides')
							->where('user_wish_rides.id', $id)
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function passenger_update($id){
		$preference_array = implode(',', $this->input->post('preference'));
		
		$data = array(
			'start_time' => $this->input->post('hour').':'.$this->input->post('minute').":00",
			'storage' => $this->input->post('storage'),
			'preference' => $preference_array
		);
		
		$this->db->update('user_wish_rides', $data, array('id'=>$id));
	}
	
	public function passenger_list($id, $what = '') {
		if($this->session->userdata('validated') == false):
			$id = $id;
		else:
			$id = $this->session->userdata('user_id');
		endif;
		
		$query = $this->db->select('user_wish_rides.id, user_wish_rides.route_from as origins, user_wish_rides.route_to as destination, start_time')
							->from('user_wish_rides')
							->join('user', 'user.user_id = user_wish_rides.user_id')
							->where('user_wish_rides.user_id', $id)
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
							->join('user_media', 'user_media.user_id = user.user_id', 'left')
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
	
		$about_me 		= $this->input->post('about_me');
		$firstname 		= $this->input->post('firstname');
		$lastname 		= $this->input->post('lastname');
		$job 			= $this->input->post('work');
		$birthdate 		= $this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('day');
		$address_no 	= $this->input->post('address_no');
		$street 		= $this->input->post('street');
		$postal 		= $this->input->post('postal');
		$city_country 	= $this->input->post('city_country');
		$mobile 		= $this->input->post('mobile');
		$phone 			= $this->input->post('phone');
	
		$this->db->query("UPDATE user, user_additional_information, user_address, user_mobile 
							SET user.firstname = '{$firstname}', 
							    user.lastname = '{$lastname}',
								user_additional_information.about_me = '{$about_me}',
								user_additional_information.job = '{$job}',
								user_additional_information.birthdate = '{$birthdate}',
								user_address.address_no = '{$address_no}',
								user_address.street = '{$street}', 
								user_address.city_country = '{$street}',
								user_address.postal = '{$postal}',
								user_mobile.number = '{$mobile}',
								user_mobile.phone = '{$phone}'
							WHERE user.user_id = '{$user_id}' AND user_additional_information.user_id = '{$user_id}' AND user.user_id = user_address.user_id AND user.user_id = user_mobile.user_id  = '{$user_id}'");
		
		return true;
	}
	
	public function update_media($user_id, $image_data) {
		$data = array(
			'user_id'				=> $user_id,
			'media_filename' 		=> $image_data['file_name'],
			'media_description' 	=> 'Profile Image',
			'media_type' 			=> $image_data['image_type']
		);	
	
		$query = $this->db->select('*')
							->from('user_media')
							->where('user_id', $user_id)
							->get();
		
		if($query->num_rows() > 0):
			$this->db->update('user_media', $data, array('user_id' => $user_id));
		else:
			$this->db->insert('user_media', $data);
		endif;
		
		return true;
	}
	
	public function update_settings($user_id) {
		$data = array(
			'password'	=> md5($this->input->post('password'))
		);
		
		$this->db->update('user', $data, array('user_id' => $user_id));
	}
	
	public function billing_information($what = 'firstname, lastname, type, amount, start_date, end_date') {
		$query = $this->db->select($what)
							->from('subscription')
							->join('user', 'user.user_id = subscription.user_id')
							->join('subscription_type', 'subscription_type.subscription_id = subscription.subscription_type')
							->where('subscription.user_id', $this->session->userdata('user_id'))
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return false;
		return $result;
	}
	
	public function billing_information_status($what = 'amount, start_date, end_date') {
		$query = $this->db->select($what)
							->from('subscription')
							->join('subscription_type', 'subscription_type.subscription_id = subscription.subscription_type')
							->where('subscription.user_id', $this->session->userdata('user_id'))
							->limit(1)
							->order_by('end_date', 'desc')
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return false;
		return $result;
	}
	
	public function billing_total($what = 'SUM(amount) as total') {
		$query = $this->db->select($what)
							->from('subscription')
							->join('user', 'user.user_id = subscription.user_id')
							->join('subscription_type', 'subscription_type.subscription_id = subscription.subscription_type')
							->where('subscription.user_id', $this->session->userdata('user_id'))
							->get();
							
		$result = $query->result_array();
		if(count($result) == 0) return false;
		return $result;
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
	
	public function car($id, $what = 'user_car.car_model as car, user_car.license_plate as plate, door, seat, transmission, air_condition, fuel, year, media_filename as image') {
		$query = $this->db->select($what)
							->from('user_car')
							->join('user_media', 'user_media.user_id = user_car.user_id', 'left')
							->where('user_car.user_id', $id)
							->or_where('user_media.media_name', 'Car Image')
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function car_update($id) {
		$data = array(
			'car_model'			=> $this->input->post('model'),
			'license_plate' 	=> $this->input->post('plate'),
			'door' 				=> $this->input->post('door'),
			'seat' 				=> $this->input->post('seat'),
			'transmission' 		=> $this->input->post('model'),
			'air_condition'		=> $this->input->post('air_con'),
			'fuel'				=> $this->input->post('fuel'),
			'year'				=> $this->input->post('year')
		);
		
		$this->db->update('user_car', $data, array('user_id'=>$id));
	}
	
	public function count_user($what = 'COUNT(user.user_id) as users') {
		$query = $this->db->select($what)
							->from('user')
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function co2($id, $what = 'co2'){  
		$query  =  $this->db->select_sum($what)
								->from('lift_seat_booked')
								->where('lift_seat_booked.user_id', $id)
								->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
}