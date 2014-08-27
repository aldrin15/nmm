<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lang extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->load->view('library_view');
	}
	
	public function en() {
		$this->session->set_userdata('lang', 'en');
		
		$ref = $this->input->server('HTTP_REFERER', TRUE);
		redirect($ref, 'location');
	}
	
	public function de() {
		$this->session->set_userdata('lang', 'de');
		
		$ref = $this->input->server('HTTP_REFERER', TRUE);
		redirect($ref, 'location');
	}
	
	public function dk() {
		$this->session->set_userdata('lang', 'dk');
		
		$ref = $this->input->server('HTTP_REFERER', TRUE);
		redirect($ref, 'location');
	}
	
	public function tr() {
		$this->session->set_userdata('lang', 'tr');
		
		$ref = $this->input->server('HTTP_REFERER', TRUE);
		redirect($ref, 'location');
	}
	
	public function ru() {
		$this->session->set_userdata('lang', 'ru');
		
		$ref = $this->input->server('HTTP_REFERER', TRUE);
		redirect($ref, 'location');
	}
}