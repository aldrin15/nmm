<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register_model extends CI_Model {
	
	function insert($rand) {
		
		$insert_user = array(
			'firstname'		=> $this->input->post('firstname'),
			'lastname'		=> $this->input->post('lastname'),
			'email'			=> $this->input->post('email'),
			'password'		=> md5($this->input->post('password')),
			'account_status'=> 'Not Activated',
			'date'			=> date("Y-m-d H:i:s")
		);
		
		$email_verification = array(
			'email'			=> $this->input->post('email'),
			'code'			=> $rand,
		);
		
		$insert = $this->db->insert('user', $insert_user);
		$verification = $this->db->insert('user_verification', $email_verification);
		
		return $insert;
	}
	
	function verify($code) {
		
		if($code):
			$query = $this->db->get_where('user_verification', array('code' => $code));
			
			foreach($query->result() as $row):
				$email = $row->email;
			endforeach;
			
			$data = array(
				'account_status' => 'Activated'
			);
		
			$this->db->update('user', $data, array('email' => $email));
			
			$get_data = $this->db->get_where('user', array('email'=> $email));
			
			foreach($get_data->result() as $row):
				$user_id = array(
					'user_id' => $row->user_id
				);
				
				$this->db->insert('user_address', $user_id);
				$this->db->insert('user_mobile', $user_id);
			endforeach;
			
			return true;
		endif;
	}
}