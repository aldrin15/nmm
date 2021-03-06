<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register_model extends CI_Model {
	
	function free_trial($rand) {
		$account_type = $this->input->post('account_type');
		
		$insert_user = array(
			'user_role'			=> 'member',
			'firstname'			=> $this->input->post('firstname'),
			'lastname'			=> $this->input->post('lastname'),
			'gender'			=> $this->input->post('gender'),
			'email'				=> $this->input->post('email'),
			'password'			=> md5($this->input->post('password')),
			'account_status'	=> 'Not Activated',
			'subscription_type'	=> $account_type[0],
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
	
	function membership($rand, $firstname, $lastname, $gender, $email, $password, $subscription) {
		$insert_user = array(
			'firstname'			=> $firstname,
			'lastname'			=> $lastname,
			'gender'			=> $gender,
			'email'				=> $email,
			'password'			=> md5($password),
			'account_status'	=> 'Not Activated',
			'subscription_type'	=> $subscription,
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
	
	function membership_amount($id, $what = '*') {
		$query = $this->db->select($what)
							->from('subscription_type')
							->where('subscription_id', $id)
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function verify($code) {
		$query = $this->db->select('*')
							->from('user_verification')
							->where('code', $code)
							->get();
		
		$result = $query->result();
		if(count($result) == 0) return false;
		
		foreach($result as $row):
			$email = $row->email;
		endforeach;
		
		if($email != ''):
			$check_status_query = $this->db->select('*')
												->from('user')
												->where('email', $email)
												->get();
			
			foreach($check_status_query->result() as $value):
				if($value->account_status == 'Not Activated'):
					$data = array( 'account_status' => 'Activated' );
					
					$this->db->update('user', $data, array('email' => $email));
					
					$user_id = array( 'user_id' => $value->user_id );
					$date = date('Y-m-d H:i:s', strtotime($value->date));
					
					if($value->subscription_type == 1):
						$date = date("Y-m-d H:i:s", strtotime($date ." +14 day") );
					elseif($value->subscription_type == 2):
						$date = date("Y-m-d H:i:s", strtotime($date ." +30 day") );
					elseif($value->subscription_type == 3):
						$date = date("Y-m-d H:i:s", strtotime($date ." +180 day") );
					else:
						$date = date("Y-m-d H:i:s", strtotime($date ." +360 day") );
					endif;
					
					$subscription = array( 
						'user_id' 			=> $value->user_id, 
						'subscription_type' => $value->subscription_type,
						'start_date'		=> date('Y-m-d H:i:s', strtotime($value->date)),
						'end_date'			=> $date
					);
					
					$this->db->insert('user_address', $user_id);
					$this->db->insert('user_mobile', $user_id);
					$this->db->insert('user_additional_information', $user_id);
					$this->db->insert('user_car', $user_id);
					$this->db->insert('subscription', $subscription);
				endif;
			endforeach;
		endif;
		
		$this->db->delete('user_verification', array('code'=>$code));
	}
	
	function check_membership_verification($orderID, $what = 'email, code') {
		$query = $this->db->select($what)
					->from('user_verification')
					->where('code', $orderID)
					->get();
					
		$result = $query->result_array();
		
		if(count($result) == 0):
			return False;
		else:
			$result['email'];
			
			$data = array( 'account_status' => 'Activated' );
			
			$this->db->update('user', $data, "email = {$result['email']}");
		endif;
	}
	
	function validate_user($email) {
		$data = array( 'account_status' => 'Activated' );
		
		$this->db->update('user', $data, array('email' => $email));
		
		$query = $this->db->query("SELECT * FROM user WHERE email = '{$email}'");		
		$row = $query->result_array();
		
		foreach($row as $value):
			$data = array('user_id' => $value['user_id']);
			$date = date('Y-m-d H:i:s');
			
			if($value['subscription_type'] == 2):
				$expiration = time()+86400*30;
			elseif($value['subscription_type'] == 3):
				$expiration = time()+86400*180;
			elseif($value['subscription_type'] == 4):
				$expiration = time()+86400*365;
			endif;
			
			$data2 = array('user_id' => $value['user_id'], 'subscription_type'=>$value['subscription_type'], 'start_date'=>$date, 'end_date'=>date('Y-m-d H:i:s', $expiration));
		endforeach;
		
		$this->db->insert('user_address', $data);
		$this->db->insert('user_mobile', $data);
		$this->db->insert('user_additional_information', $data);
		$this->db->insert('user_car', $data);
		$this->db->insert('subscription', $data2);
	}
}