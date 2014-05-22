<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->library('email');
	}
	
	public function sendEmailVerification($email, $message) {
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
		$this->email->message($message);

		$this->email->send();
	}
	
	public function sendEmail($email, $message) {
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
		$this->email->message($message);

		$this->email->send();
	}
}