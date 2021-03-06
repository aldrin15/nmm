<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {
	
	function validate() {
        // grab user input
        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean(md5($this->input->post('password')));
        
        // Check query
		$query = $this->db->get_where('user', array('email' => $username, 'password' => $password));
		
        // Let's check if there are any results
        if($query->num_rows == 1)
        {
            // If there is a user, then create session data
            $row = $query->row();
			
			$data = array(
				'user_id' 	=> $row->user_id,
				'username' 	=> $row->email,
				'firstname'	=> $row->firstname,
				'validated' => true
            );
			
            $this->session->set_userdata($data);
		
            return true;
        }
        // If the previous process did not validate
        // then return false.
        return false;	
	}
	
	function fb_validate($email) {
		$user_email = $this->security->xss_clean($email);
		
		$query = $this->db->get_where('user', array('email'=>$user_email));
		
		if($query->num_rows == 1):
			$row = $query->row();
			
			$data = array(
				'user_id' => $row->user_id,
				'username' => $row->email,
				'firstname' => $row->firstname,
				'validated' => true
			);
			
			$this->session->set_userdata($data);
			
			return true;
		endif;
		
		return false;
	}
	
	function forgot_account() {
		$this->load->library('email');
		$query = $this->db->get_where('user', array('email' => $this->input->post('email')));
		
		if($query->num_rows() == 1):
			
			foreach($query->result() as $row):
				$firstname  = $row->firstname;
				$email		= $row->email;
			endforeach;
			
			function rand_string( $length ) {
				$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
				return substr(str_shuffle($chars),0,$length);
			
			}
			
			$newpassword = rand_string(10);
			
			$data = array(
				'password' => md5($newpassword)
			);
			
			$this->db->update('user', $data, array('email' => $email));
			
			$config['mailpath'] = "/usr/sbin/sendmail";
			$config['protocol'] = "sendmail";
			$config['mailtype'] = "html";				

			$this->email->initialize($config);		
			$this->email->from('admin@nmm.com', 'Admin Team');		
			$this->email->to($email); 		
			$this->email->subject('Forgot Password');		
			$this->email->message("Dear ".$firstname."\n\nHere is your new password for NMM.\n\nPassword: ".$newpassword."\n\nIf you have any problems or questions, don't hesitate to contact admin@nmm.com for assistance.\n\nThank you");

			$this->email->send();
			
			return true;
		else:
			echo "<p>This Email does not exist.</p>";
		endif;
	}
	
	function user_sessions($user_id, $ip, $last_login) {
		$query = $this->db->get_where('user_sessions', array('user_id'=>$user_id));
		
		$result = $query->result();
		
		if(count($result) == 0):
			$data = array(
				'user_id' 	=> $user_id,
				'ip'		=> $ip,
				'last_login'=> $last_login
			);
			
			$this->db->insert('user_sessions', $data);
		else:
			$data = array(
				'last_login' => $last_login
			);
			$update = $this->db->update('user_sessions', $data, array('user_id'=>$user_id));		
		endif;
	}
	
	function check_user($email, $what = 'email') {
		$query = $this->db->select($what)
							->from('user')
							->where('email', $email)
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
	
	function check_user_login($email, $what = 'email') {
		$query = $this->db->select($what)
							->from('user')
							->where('email', $email)
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
}