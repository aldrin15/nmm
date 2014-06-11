<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Event_model extends CI_Model {
	
	public function create() {
		$data = array(
			'user_id'		=> $this->input->post('user_id');
			'event_type' 	=> $this->input->post('event_type'),
			'title'			=> $this->input->post('title'),
			'address'		=> $this->input->post('address'),
			'dates'			=> $this->input->post('dates'),
			'image'			=> $this->input->post('image'),
			'remarks'		=> $this->input->post('remarks')
		);
		
		$this->db->select('events', $data);
	}
}