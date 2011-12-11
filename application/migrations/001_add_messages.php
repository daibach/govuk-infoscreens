<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_messages extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field('id');
		$this->dbforge->add_field(array(
			'action' => array(
				'type' => 'INT',
				'constraint' => '5',
			),
			'user' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'format' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'title' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'subject' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'content' => array(
				'type' => 'TEXT'
			),
			'action_date' => array(
				'type' => 'TIMESTAMP',
				'null' => TRUE
			)
		));
		$this->dbforge->add_field('created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP');
		
		$this->dbforge->create_table('messages');
	}

	public function down()
	{
		$this->dbforge->drop_table('messages');
	}
}