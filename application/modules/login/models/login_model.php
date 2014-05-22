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
			
			$config['protocol'] 	= 'smtp';
			$config['mailpath'] 	= '/usr/sbin/sendmail';
			$config['charset'] 		= 'iso-8859-1';
			$config['smtp_host']    = 'ssl://smtp.gmail.com';
			$config['smtp_port']    = '465';
			$config['smtp_user']    = 'damingalam99@gmail.com';
			$config['smtp_pass']    = '!123qweasd';
			$config['newline']    	= "\r\n";
			$config['wordwrap'] 	= TRUE;

			$this->email->initialize($config);
			$this->email->from('admin@nmm.com', 'Admin Team');
			$this->email->to($email); 
			$this->email->subject('Email Verification');
			$this->email->message("Dear ".$firstname."\n\nHere is your new password for NMM.\n\nPassword: ".$newpassword."\n\nIf you have any problems or questions, don't hesitate to contact admin@nmm.com for assistance.\n\nThank you");

			$this->email->send();
			
			return true;
		else:
			echo "<p>This Email does not exist.</p>";
		endif;
	}
}