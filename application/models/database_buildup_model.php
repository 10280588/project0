<?php
class Database_buildup_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function create_rv_table()
	{
	    $this->load->dbforge();
	    $rv_fields = array(
                        'recently_viewed_number' => array(
                                                 'type' => 'INT', 
                                                 'unsigned' => TRUE,
                                                 'constraint' => '10',
                                          ),
                        'user_id' => array(
                                                 'type' => 'INT',
                                                 'unsigned' => TRUE,
                                                 'constraint' => '9',
                                          ),
                        'course_unique' => array(
                                                 'type' => 'INT',
                                                 'unsigned' => TRUE,
                                                 'constraint' => '10',
                                          ),
                        'time_viewed' => array(
                                                 'type' =>'TIMESTAMP',
                                          )
                );
                
        $this->dbforge->add_field($rv_fields);
        $this->dbforge->add_key('user_id', TRUE);
        $this->dbforge->create_table('Recently_Viewed', TRUE);
	}
    public function create_user_tables()
    {
        $this->load->dbforge();
        $user_fields = array(
                        'user_id' => array(
                                                 'type' => 'INT', 
                                                 'unsigned' => TRUE,
                                                 'constraint' => '9',
                                          ),
                        'first_name' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '128',
                                          ),
                        'last_name' => array(
                                                 'type' => 'VARCHAR',
                                                 'constraint' => '128',
                                          ),
                        'password' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '128',
                                          )
                );
        $this->dbforge->add_field($user_fields);
        $this->dbforge->add_key('user_id', TRUE);
        $this->dbforge->create_table('User', TRUE);
        
        $course_user_fields = array(
                                'course_user_number' => array(
                                                         'type' => 'INT', 
                                                         'unsigned' => TRUE,
                                                         'constraint' => '10',
                                                         'auto_increment' => TRUE
                                                  ),
                                'user_id' => array(
                                                         'type' => 'INT', 
                                                         'unsigned' => TRUE,
                                                         'constraint' => '10',
                                                  ),
                                'course_unique' => array(
                                                         'type' => 'INT', 
                                                         'unsigned' => TRUE,
                                                         'constraint' => '10',
                                                  )
                            );
        $this->dbforge->add_field($course_user_fields);
        $this->dbforge->add_key('course_user_number', TRUE);
        $this->dbforge->create_table('Course_User', TRUE);
        
        $user = array(
       'user_id' => '1234' ,
       'first_name' => 'J' ,
       'last_name' => 'harvard',
       'password' => sha1('crimson')
        );

        $this->db->insert('User', $user); 
    }     
}
