<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nmm extends MX_Controller {
	
	public function __construct() {
		parent::__construct();
		
		$this->_view_module				= 'nmm';
		$this->_view_template_name		= 'includes/';
		$this->_view_template_layout	= 'main_view';
		$this->_view_content			= '';
		
		modules::run('login/index');
	}
	
	public function index() {
		$data['view_file'] = 'index_view';
		echo modules::run('template/my_template', $this->_view_module, $this->_view_template_name, $this->_view_template_layout, $data);
	}
	
	public function test() {
		$this->load->model('nmm_model');
		$test = $this->nmm_model->test();
		$test2 = $this->nmm_model->test2();
		

		/*
		 * Test 1
		 */
		echo '<select name="" id="">';
		foreach($test as $row):
			echo '<option>'.$row->name.' '.$row->continent_code.'</option>';
		endforeach;
		echo '</select>';

		echo '<br />';
		
		
		/*
		 * Test 2
		 */
		$city = array();
		
		foreach($test2 as $key => $row):
			$print = array($row->combined);
			$print = preg_replace('/^([^,]*).*$/', '$1', $print);
			
			$city[] = $print;
		endforeach;
		
		echo '<select>';
		for($i = 0; $i < count($city); $i++):
			echo '<option>'.$city[$i][0].'</option>';
		endfor;
		echo '</select>';
	}
}