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
		$this->load->library(array('form_validation', 'icepay_api_basic', 'email'));
		
		$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->session->set_userdata('refered_from', $url);
		
		/*  Define your ICEPAY Merchant ID and Secret code. The values below are sample values and will not work, Change them to your own merchant settings. */
		define('MERCHANTID', 23405);//<--- Change this into your own merchant ID
		define('SECRETCODE', "Ny79KcLr6g4E5RuFs8m3BJe9w5WDn67QxYp3q4GC");//<--- Change this into your own merchant ID 
		define('EMAIL',"ivan@appenvy.dk");//<--- Change this into your own e-mail address
		
		modules::run('lang/index');
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
				$rand 		= random_string('unique');
				$message	= "Dear ".$this->input->post('email').",\n\nPlease click on below URL or paste into your browser to verify your Email Address\n\n ".base_url('register/verify/')."/".$rand."\n"."\n\nThanks\nAdmin Team";
				
				$data = array(
					'firstname' => $this->input->post('firstname'),
					'lastname' => $this->input->post('lastname'),
					'gender' => $this->input->post('gender'),
					'email' => $this->input->post('email'),
					'password' => $this->input->post('password'),
					'email' => $this->input->post('email'),
					'membership' => $this->input->post('account_type')
				);
				
				if($data['membership'][0] == 1):
					$this->register_model->free_trial($rand);

					modules::run('email/sendEmailVerification', $this->input->post('email'), $message);

					redirect('register/successful', 'refresh');
				elseif($data['membership'][0] == 2):
					$length 		= 10;
					$randomString 	= substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
					$this->session->set_userdata('registered_session', $data);
					$user_data = $this->session->userdata('registered_session');
					
					$this->register_model->membership($randomString, $user_data['firstname'], $user_data['lastname'], $user_data['gender'], $user_data['email'], $user_data['password'], $data['membership'][0]);
					$amount = $this->register_model->membership_amount(2);
					
					/* Apply logging rules */
					$logger = Icepay_Api_Logger::getInstance();
					$logger->enableLogging()
							->setLoggingLevel(Icepay_Api_Logger::LEVEL_ALL)
							->logToFile()
							->setLoggingDirectory(realpath("../logs"))
							->setLoggingFile("basicmode.txt")
							->logToScreen();
					
					foreach($amount as $row):
						/* Set the paymentObject */
						$paymentObj = new Icepay_PaymentObject();
						$paymentObj->setAmount($row['amount']*100)	
									->setCountry("DE")
									->setLanguage("EN")
									->setReference("Nimm Mich Mit")
									->setDescription("Membership Account")
									->setCurrency("EUR")
									->setOrderID($randomString);									
					endforeach;
					
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
				elseif($data['membership'][0] == 3):
					$length 		= 10;
					$randomString 	= substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
					$this->session->set_userdata('registered_session', $data);
					$user_data = $this->session->userdata('registered_session');
					
					$this->register_model->membership($randomString, $user_data['firstname'], $user_data['lastname'], $user_data['gender'], $user_data['email'], $user_data['password'], $data['membership'][0]);
					$amount = $this->register_model->membership_amount(3);
					
					/* Apply logging rules */
					$logger = Icepay_Api_Logger::getInstance();
					$logger->enableLogging()
							->setLoggingLevel(Icepay_Api_Logger::LEVEL_ALL)
							->logToFile()
							->setLoggingDirectory(realpath("../logs"))
							->setLoggingFile("basicmode.txt")
							->logToScreen();
					
					foreach($amount as $row):
						/* Set the paymentObject */
						$paymentObj = new Icepay_PaymentObject();
						$paymentObj->setAmount($row['amount']*100)	
									->setCountry("DE")
									->setLanguage("EN")
									->setReference("Nimm Mich Mit")
									->setDescription("Membership Account")
									->setCurrency("EUR")
									->setOrderID($randomString);									
					endforeach;
					
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
				elseif($data['membership'][0] == 4):
					$length 		= 10;
					$randomString 	= substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
					$this->session->set_userdata('registered_session', $data);
					$user_data = $this->session->userdata('registered_session');
					
					$this->register_model->membership($randomString, $user_data['firstname'], $user_data['lastname'], $user_data['gender'], $user_data['email'], $user_data['password'], $data['membership'][0]);
					$amount = $this->register_model->membership_amount(4);
					
					/* Apply logging rules */
					$logger = Icepay_Api_Logger::getInstance();
					$logger->enableLogging()
							->setLoggingLevel(Icepay_Api_Logger::LEVEL_ALL)
							->logToFile()
							->setLoggingDirectory(realpath("../logs"))
							->setLoggingFile("basicmode.txt")
							->logToScreen();
					
					foreach($amount as $row):
						/* Set the paymentObject */
						$paymentObj = new Icepay_PaymentObject();
						$paymentObj->setAmount($row['amount']*100)	
									->setCountry("DE")
									->setLanguage("EN")
									->setReference("Nimm Mich Mit")
									->setDescription("Membership Account")
									->setCurrency("EUR")
									->setOrderID($randomString);									
					endforeach;
					
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
		endif;
	
		$data['translate'] = $this->session->userdata('translate');
		$data['view_file'] = 'register_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function successful() {
		$data['translate'] = $this->session->userdata('translate');
		$data['view_file'] = 'register_successful_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function verify() {
		$code = $this->uri->segment(3);
		
		$data['verification'] = $this->register_model->verify($code);
	}
	
	public function thank_you() {
		if($_GET['Status'] == 'OK') {
			$data['user_data'] = $this->session->userdata('registered_session');
			
			$email = $data['user_data']['email'];
			
			$this->register_model->validate_user($email);
			
			$message = "Dear ".$email.",\n\nRegister Successful\n\nYou are now registered with Nimm Mich Mit membership account <table><th><td>Registrant</td><td>Type</td><td>Price</td></th><tbody><td>".$email."</td></tbody></table>\n\nIf you need any help just email us at <a href='mailto:support@nmm-nmm.de'>support@nmm-nmm.de</a>";
			modules::run('email/sendEmail', $email, $message);
			
			redirect('nmm');
		}
		
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
		$data['user_data'] = $this->session->userdata('registered_session');
		$data['email'] = $data['user_data']['email'];
		
		var_dump($data['email']);
		
		$this->load->view('register_payment_postback_view', $data);
	}
}