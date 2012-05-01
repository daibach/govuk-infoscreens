<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message_model extends CI_Model {

  public function store_message($action,$user,$format,$title,$subject,$content,$date,$business=0) {

      if($format == 'Localtransaction') $format = 'Local transaction';

      $data = array(
        'action'            =>$action,
        'user'              =>trim($user),
        'format'            =>trim($format),
        'title'             =>trim($title),
        'subject'           =>trim($subject),
        'content'           =>$content,
        'action_date'       =>date('Y-m-d H:i:s',$date),
        'business_content'  => $business
      );

      $this->db->insert('messages',$data);

  }

  public function load_recent_messages($action_type,$limit=10,$action_id=0,$format='citizen') {

    $this->db->where('action_type',$action_type);
    $this->db->join('actions','actions.id=messages.action');
    $this->db->join('authors','authors.user_name=messages.user');
    $this->db->order_by('action_date','desc');
    if($limit > 0) { $this->db->limit($limit); }
    if($action_id > 0) { $this->db->where('actions.id',$action_id); }
    if($format=='business') {
      $this->db->where('business_content',1);
    } else {
      $this->db->where('business_content',0);
    }
    $query = $this->db->get('messages');

    if($query->num_rows() > 0) {
      return $query->result();
    } else {
      return array();
    }

  }

  public function load_count_date($date,$format='citizen') {

    $this->db->select('action_name,count(*) as count');
    $this->db->join('actions','actions.id=messages.action');
    $this->db->where('action_date LIKE',date('Y-m-d',$date).'%');
    if($format=='business') {
      $this->db->where('business_content',1);
    } else {
      $this->db->where('business_content',0);
    }
    $this->db->group_by('action_name');

    $query = $this->db->get('messages');

    if($query->num_rows() > 0) {
      return $query->result();
    } else {
      return array();
    }

  }

  public function load_count_week($date,$format='citizen') {

    $this->db->select('action_name,count(*) as count');
    $this->db->join('actions','actions.id=messages.action');
    $this->db->where('WEEK(action_date)','WEEK("'.date('Y-m-d',$date).'")',false);
    if($format=='business') {
      $this->db->where('business_content',1);
    } else {
      $this->db->where('business_content',0);
    }
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