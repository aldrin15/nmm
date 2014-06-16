<?php if( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Abroad_model extends CI_Model {
	public function country($what = 'code, name') {
		$query = $this->db->select($what)
							->from('countries')
							->get();
		
		$result = $query->result_array();
		if(count($result) == 0) return FALSE;
		return $result;
	}
}