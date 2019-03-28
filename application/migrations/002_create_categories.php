<?php
defined('BASEPATH') OR exit('No direct scipt access allowed');

class Migration_Create_Categories extends CI_Migration
{
    public function __construct()
    {
        parent::__construct();
    }
    public function up()
    {
        $this->dbforge->add_field(array(
            'id'=> array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'category_name'=> array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'status'=> array(
                'type' => 'VARCHAR',
                'constraint' => 10,
                'default'=>'Active'
            ),
            
        ));
        $this->dbforge->add_key('id',TRUE);
        $this->dbforge->create_table('categories');
    }
    public function down()
    {
        $this->dbforge->drop_table('categories');
    }
}