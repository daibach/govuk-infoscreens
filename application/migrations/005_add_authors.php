<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_authors extends CI_Migration {

  public function up()
  {
    $this->_create_author_table();
    $this->_tidy_existing_users();
    $this->_create_initial_authors();
  }

  public function down()
  {
    $this->dbforge->drop_table('authors');
  }

  function _create_author_table() {
    $this->dbforge->add_field('id');
    $this->dbforge->add_field(array(
      'user_name' => array(
        'type' => 'VARCHAR',
        'constraint' => '50',
      ),
      'gravatar_hash' => array(
        'type' => 'VARCHAR',
        'constraint' => '255',
      )
    ));
    $this->dbforge->add_key('user_name');

    $this->dbforge->create_table('authors');
  }

  function _tidy_existing_users() {

    $this->db->select('user');
    $this->db->distinct();
    $this->db->order_by('user');
    $query = $this->db->get('messages');

    if($query->num_rows() > 0) {
      $authors = $query->result();

      foreach($authors as $a) {

        $author_clean = trim($a->user);

        $data = array('user'=>$author_clean);
        $this->db->where('user',$a->user);
        $this->db->update('messages',$data);

      }
    }


  }

  function _create_initial_authors() {

    $this->db->select('user');
    $this->db->distinct();
    $this->db->order_by('user');
    $this->db->where('user !=','');
    $query = $this->db->get('messages');

    if($query->num_rows() > 0) {
      $authors = $query->result();
      foreach($authors as $a) {

        $data = array('user_name' => $a->user);
        $this->db->insert('authors',$data);

      }

    }

  }

}