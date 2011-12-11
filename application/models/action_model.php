<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action_model extends CI_Model {
	
	public function identify_action_id($string) {
		
		$this->db->where('action_name',$string);
		
		$query = $this->db->get('actions');
		
		if($query->num_rows() > 0) {
			return $query->row()->id;
		}	else {
			return 0;
		}
		
	}
	
}