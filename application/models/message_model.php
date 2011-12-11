<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message_model extends CI_Model {
	
	public function store_message($action,$user,$format,$title,$subject,$content,$date) {
			
			$data = array(
				'action'			=>$action,
				'user'				=>$user,
				'format'			=>$format,
				'title'				=>$title,
				'subject'			=>$subject,
				'content'			=>$content,
				'action_date' =>date('Y-m-d H:i:s',$date)
			);
			
			$this->db->insert('messages',$data);

	}
	
	public function load_recent_messages($action_type,$limit=10) {
		
		$this->db->where('action_type',$action_type);
		$this->db->join('actions','actions.id=messages.action');
		$this->db->order_by('action_date','desc');
		if($limit > 0) { $this->db->limit($limit); }
		$query = $this->db->get('messages');
		
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return array();
		}
		
	}
	
	public function load_count_date($date) {

		$this->db->select('action_name,count(*) as count');
		$this->db->join('actions','actions.id=messages.action');
		$this->db->where('action_date LIKE',date('Y-m-d',$date).'%');
		$this->db->group_by('action_name');
		
		$query = $this->db->get('messages');
		
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return array();
		}
		
	}
	
	public function load_count_week($date) {

		$this->db->select('action_name,count(*) as count');
		$this->db->join('actions','actions.id=messages.action');
		$this->db->where('WEEK(action_date)','WEEK("'.date('Y-m-d',$date).'")',false);
		$this->db->group_by('action_name');
		
		$query = $this->db->get('messages');
		
		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return array();
		}
		
	}
	
	public function convert_count_result($data) {
	  
	  $result = array();
	  
	  foreach($data as $row) {
	    $result[$row->action_name] = $row->count;
	  }
	  
	  return $result;
	  
	}
	
	
}