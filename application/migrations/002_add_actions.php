<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_actions extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field('id');
		$this->dbforge->add_field(array(
			'action_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
			),
			'action_type' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
			),
			'action_format' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
			)
		));
		
		$this->dbforge->create_table('actions');
	}

	public function down()
	{
		$this->dbforge->drop_table('actions');
	}
}