<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register_model extends CI_Model {
	
	function insert($rand) {
		
		$insert_user = array(
			'firstname'			=> $this->input->post('firstname'),
			'lastname'			=> $this->input->post('lastname'),
			'gender'			=> $this->input->post('gender'),
			'email'				=> $this->input->post('email'),
			'password'			=> md5($this->input->post('password')),
			'account_status'	=> 'Not Activated',
			'subscription_type'	=> $this->input->post('account_type'),
			'date'				=> date("Y-m-d H:i:s")
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
				$user_id = array( 'user_id' => $row->user_id );
				
				$date = date('Y-m-d H:i:s', strtotime($row->date));
				
				if($row->subscription_type == 1):
					$date = date("Y-m-d H:i:s", strtotime($date ." +14 day") );
				elseif($row->subscription_type == 2):
					$date = date("Y-m-d H:i:s", strtotime($date ." +30 day") );
				elseif($row->subscription_type == 3):
					$date = date("Y-m-d H:i:s", strtotime($date ." +180 day") );
				else:
					$date = date("Y-m-d H:i:s", strtotime($date ." +360 day") );
				endif;
				
				$subscription = array( 
					'user_id' 			=> $row->user_id, 
					'subscription_type' => $row->subscription_type,
					'start_date'		=> date('Y-m-d H:i:s', strtotime($row->date)),
					'end_date'			=> $date
				);
				
				$this->db->insert('user_address', $user_id);
				$this->db->insert('user_mobile', $user_id);
				$this->db->insert('user_additional_information', $user_id);
				$this->db->insert('user_car', $user_id);
				$this->db->insert('subscription', $subscription);
			endforeach;
			
			return true;
		endif;
	}
}