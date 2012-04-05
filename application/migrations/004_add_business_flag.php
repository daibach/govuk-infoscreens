<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_business_flag extends CI_Migration {

  public function up()
  {
    $fields = array(
      'business_content' => array(
        'type'    => 'TINYINT',
        'default' => 0
      )
    );
    $this->dbforge->add_column('messages',$fields);
  }

  public function down()
  {
    $this->dbforge->drop_column('messages','business_content');
  }
}