<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller {
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		echo 'Login View';
	}
}