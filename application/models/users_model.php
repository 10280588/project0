<?php
class Users_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	   
     public function create_db_tables()
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
    
    public function create_cookie($uid)
    {     
        $cookie = array(
        'name'   => 'uid',
        'value'  => $uid,
        'expire' => '0',
        'domain' => '.project0',
        'path'   => '/',
        'secure' => TRUE
        );

        $this->input->set_cookie($cookie);
    }
    
    public function get_user_name($uid)
    {
        $this->db->select('first_name, last_name');
        $this->db->from('User');
        $this->db->where('user_id',$uid);
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>
