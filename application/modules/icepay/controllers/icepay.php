<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Icepay extends MX_Controller {
	public function __construct() {
		parent::__construct();
	}
	
	public function payment($rand, $amount) { 
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

		/*  Define your ICEPAY Merchant ID and Secret code. The values below are sample values and will not work, Change them to your own merchant settings. */
		define('MERCHANTID', 23405);//<--- Change this into your own merchant ID
		define('SECRETCODE', "Ny79KcLr6g4E5RuFs8m3BJe9w5WDn67QxYp3q4GC");//<--- Change this into your own merchant ID 

		// Include the API
		// require_once '../api/icepay_api_basic.php';
		$this->load->library('icepay_api_basic');
		// $this->load->view('register_payment_view');
		
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
		$paymentObj->setAmount($amount)
					->setCountry("DE")
					->setLanguage("EN")
					->setReference("Nimm Mich Mit")
					->setDescription("Membership Account")
					->setCurrency("EUR")
					->setOrderID($rand);
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
	}
}