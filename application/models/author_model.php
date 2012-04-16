<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Author_model extends CI_Model {

  public function all() {

    $query = $this->db->get('authors');
    if($query->num_rows() > 0) {
      return $query->result();
    } else {
      return array();
    }

  }

  public function create($user_name,$gravatar_hash='') {

    $data = array(
      'user_name'     => $user_name,
      'gravatar_hash' => $gravatar_hash
    );
    $this->db->insert('authors',$data);

  }

  public function identify_missing_publication_users($known_author_array) {

    $this->db->select('user');
    $this->db->distinct();
    $this->db->where_not_in('user',$known_author_array);
    $query = $this->db->get('messages');

    if($query->num_rows() > 0) {
      return $query->result();
    } else {
      return array();
    }

  }

}