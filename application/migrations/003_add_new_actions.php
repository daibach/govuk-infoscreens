<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_new_actions extends CI_Migration {

	public function up()
	{
		$data = array('action_name'=>'created', 'action_type'=>'other', 'action_format'=>'info');
		$this->db->insert('actions',$data);
		
		$data = array('action_name'=>'assigned', 'action_type'=>'other', 'action_format'=>'info');
		$this->db->insert('actions',$data);
		
		$data = array('action_name'=>'new version', 'action_type'=>'other', 'action_format'=>'info');
		$this->db->insert('actions',$data);
	}

	public function down()
	{
	  $this->db->where('action_name','created');
	  $this->db->or_where('action_name','assigned');
	  $this->db->or_where('action_name','new version');
	  $this->db->delete('actions');
	}
}