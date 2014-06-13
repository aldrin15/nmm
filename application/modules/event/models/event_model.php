<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Event_model extends CI_Model {
	
	public function listing($what = '*') {
		$query = $this->db->select($what)
							->from('events')
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function detail($id, $what = 'events.user_id, title, address, events.date, image, remarks, firstname, lastname') {
		$query = $this->db->select($what)
							->from('events')
							->join('user', 'user.user_id = events.user_id')
							->where('events.id', $id)
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function create($image_data) {
		$today = getdate();
		$now = $today['year'].'-'.$today['mon'].'-'.$today['wday'];
		
		$data = array(
			'user_id'		=> $this->session->userdata('user_id'),
			'event_type' 	=> $this->input->post('event_type'),
			'title'			=> $this->input->post('title'),
			'city_country'	=> $this->input->post('city_country'),
			// 'address'		=> $this->input->post('address'),
			'date'			=> $this->input->post('date').' '.$this->input->post('hour').':'.$this->input->post('minute').':00',
			'image'			=> $image_data['file_name'],
			'remarks'		=> $this->input->post('remarks'),
			'date_created'	=> $now,
		);
		
		$this->db->insert('events', $data);
	}
	
	/* ==========================
	 * Populate City by Country
	 * ======================= */
	function get_city($city) {
		$query = $this->db->query("SELECT DISTINCT `combined` FROM (`user_cities`) WHERE `combined` LIKE '{$city}%'");

		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	public function country($what = '*') {
		$query = $this->db->select($what)
							->from('countries')
							->where('continent_code', 'EU')
							->get();
							
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
}