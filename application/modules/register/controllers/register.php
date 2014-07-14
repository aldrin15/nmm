<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->_view_module				= 'register';
		$this->_view_template_name		= 'includes/';
		$this->_view_template_layout	= 'main_view';
		$this->_view_content			= "";
		
		$this->load->model('register_model');
		
		// Include IcePay API
		$this->load->library(array('form_validation', 'icepay_api_basic'));
		
		$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->session->set_userdata('refered_from', $url);
		
		/*  Define your ICEPAY Merchant ID and Secret code. The values below are sample values and will not work, Change them to your own merchant settings. */
		define('MERCHANTID', 23405);//<--- Change this into your own merchant ID
		define('SECRETCODE', "Ny79KcLr6g4E5RuFs8m3BJe9w5WDn67QxYp3q4GC");//<--- Change this into your own merchant ID 
		define('EMAIL',"ivan@appenvy.dk");//<--- Change this into your own e-mail address
	}
	
	public function index() {
		$post = $this->input->post();
		
		if($post):
			$this->form_validation->set_rules('firstname', 'Firstname', 'required|trim');
			$this->form_validation->set_rules('lastname', 'Lastname', 'required|trim');
			$this->form_validation->set_rules('gender', 'Gender', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|trim');
			$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|min_length[6]|trim|matches[password]');
			$this->form_validation->set_rules('terms_condition', 'Terms and Condition', 'required');
			$this->form_validation->set_rules('account_type', 'Membership Type', 'required');
			
			if($this->form_validation->run() == TRUE):
				$rand 			= random_string('unique');
				$length 		= 10;
				$randomString 	= substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
				$message		= "Dear ".$this->input->post('email').",\n\nPlease click on below URL or paste into your browser to verify your Email Address\n\n ".base_url('register/verify/')."/".$rand."\n"."\n\nThanks\nAdmin Team";
				
				$data = array(
					'firstname' => $this->input->post('firstname'),
					'lastname' => $this->input->post('lastname'),
					'gender' => $this->input->post('gender'),
					'email' => $this->input->post('email'),
					'password' => $this->input->post('password'),
					'email' => $this->input->post('email'),
					'membership' => $this->input->post('account_type')
				);
				
				$this->session->set_userdata('registered_session', $data);
				
				$user_data = $this->session->userdata('registered_session');
				
				
				/**
				 *  ICEPAY Basicmode API 2
				 *  BasicMode sample script
				 *
				 *  @version 1.0.1
				 *  @author Olaf Abbenhuis
				 *  @copyright Copyright (c) 2011-2012, ICEPAY
				 *
				 *  Disclaimer:
				 *  These sample scripts are used for training purposes only and
				 *  should not be used in a live environment. The software is provided
				 *  "as is", without warranty of any kind, express or implied, including
				 *  but not limited to the warranties of merchantability, fitness for
				 *  a particular purpose and non-infringement. In no event shall the
				 *  authors or copyright holders be liable for any claim, damages or
				 *  other liability, whether in an action of contract, tort or otherwise,
				 *  arising from, out of or in connection with the software or the use
				 *  of other dealings in the software.
				 *
				 */
				 
				/* Apply logging rules */
				$logger = Icepay_Api_Logger::getInstance();
				$logger->enableLogging()
						->setLoggingLevel(Icepay_Api_Logger::LEVEL_ALL)
						->logToFile()
						->setLoggingDirectory(realpath("../logs"))
						->setLoggingFile("basicmode.txt")
						->logToScreen();
				
				/* Set the paymentObject */
				$paymentObj = new Icepay_PaymentObject();
				
				if($user_data['membership'][0] == 1):
					$this->register_model->free_trial($rand);
					
					modules::run('email/sendEmailVerification', $this->input->post('lastname'), $message);
					
					redirect('register/successful', 'refresh');
				elseif($user_data['membership'][0] == 2):
					$this->register_model->membership($randomString, $user_data['firstname'], $user_data['lastname'], $user_data['gender'], $user_data['email'], $user_data['password'], $user_data['email']);
					$amount = $this->register_model->membership_amount(2);
					
					foreach($amount as $row):
						$paymentObj->setAmount($row['amount']*100);							
					endforeach;
				elseif($user_data['membership'][0] == 3):
					$this->register_model->membership($randomString, $user_data['firstname'], $user_data['lastname'], $user_data['gender'], $user_data['email'], $user_data['password'], $user_data['email']);
					$amount = $this->register_model->membership_amount(3);
					
					foreach($amount as $row):
						$paymentObj->setAmount($row['amount']*100);					
					endforeach;
				elseif($user_data['membership'][0] == 4):
					$this->register_model->membership($randomString, $user_data['firstname'], $user_data['lastname'], $user_data['gender'], $user_data['email'], $user_data['password'], $user_data['email']);
					$amount = $this->register_model->membership_amount(4);
					
					foreach($amount as $row):
						$paymentObj->setAmount($row['amount']*100);		
					endforeach;
				endif;
				
				$paymentObj->setCountry("DE")
							->setLanguage("EN")
							->setReference("Nimm Mich Mit")
							->setDescription("Membership Account")
							->setCurrency("EUR")
							->setOrderID($randomString);
				
				try {
					// Merchant Settings
					$basicmode = Icepay_Basicmode::getInstance();
					$basicmode->setMerchantID(MERCHANTID)
							->setSecretCode(SECRETCODE)
							->validatePayment($paymentObj);

						redirect($basicmode->getURL());
				} catch (Exception $e){
					echo($e->getMessage());
				}
			endif;
		endif;
	
		$data['view_file'] = 'register_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function successful() {
		$data['view_file'] = 'register_successful_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function verify() {
		$code = $this->uri->segment(3);
		
		$data['verification'] = $this->register_model->verify($code);
		
		var_dump($data['verification']);
	}
	
	public function thank_you() {
		echo $_GET['Status'].'<br />';
		echo $_GET['StatusCode'].'<br />';
		echo $_GET['Merchant'].'<br />';
		echo $_GET['OrderID'].'<br />';
		echo $_GET['PaymentID'].'<br />';
		echo $_GET['Reference'].'<br />';
		echo $_GET['TransactionID'].'<br />';
		echo $_GET['Checksum'].'<br />';
		echo $_GET['PaymentMethod'].'<br />';
	}
	
	public function payment_error() {
		$this->load->view('register_payment_error_view');
	}
	
	public function payment_postback() {	
		$this->load->view('register_payment_postback_view');
	}
}