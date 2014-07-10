<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback_model extends CI_Model {
	function get_feedback($what = '') {
		$query = $this->db->select($what)
							->from('feedback')
							->get();
		$result = $query->result_array();
		if(count($result) == 0) return false;
		return $result;
	}
}