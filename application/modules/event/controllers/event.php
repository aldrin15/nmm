<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Event extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->_view_module 			= "event";
		$this->_view_template_name 		= "includes/";
		$this->_view_template_layout 	= "main_view";
		$this->_view_content 			= "";
		
		$this->load->library('form_validation');
	}
	
	public function create() {
		$post = $this->input->post();
		
		if($post):
			if(array_key_exists('create_event_submit', $post)):
				$this->form_validation->set_rules('event_type', 'Event Type', 'required');
				$this->form_validation->set_rules('title', 'Title', 'required');
				$this->form_validation->set_rules('address', 'Address', 'required');
				$this->form_validation->set_rules('dates', 'Date/s', 'required');
				
				if($this->form_validation->run() == TRUE):
					echo $this->input->post('event_type').'<br />';
					echo $this->input->post('title').'<br />';
					echo $this->input->post('address').'<br />';
					echo $this->input->post('dates').'<br />';
					echo $this->input->post('hour').'<br />';
					echo $this->input->post('minute').'<br />';
					echo $this->input->post('remarks').'<br />';
					echo $this->input->post('image').'<br />';
				endif;
			endif;
		endif;
		
		$data['view_file'] = 'event_create_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
}