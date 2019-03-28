<?php
defined('BASEPATH') OR exit('No direct scipt access allowed');

class Migration_Create_Comments extends CI_Migration
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
            
            'poster_id'=> array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE
            ),
            'commenter_id'=> array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE
            ),
            'comment_body'=>array(
                'type'=>'VARCHAR',
                'constraint'=>'200',
            ),
            'created_at timestamp default current_timestamp',
            'updated_at'=>array(
                'type'=>'VARCHAR',
                'constraint'=>'250',
                'null'=>true,
                'on update'=>'NOW()'
            )
        ));
        $this->dbforge->add_key('id',TRUE);
        $this->dbforge->create_table('comments');
    }
    public function down()
    {
        $this->dbforge->drop_table('comments');
    }
}