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
    
    public function create_uid_cookie($uid)
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
    
    public function delete_uid_cookie()
    {    
        $this->load->helper('cookie');
        delete_cookie('uid');
    }
    
    public function get_user_name($uid)
    {
        $this->db->select('first_name, last_name');
        $this->db->from('User');
        $this->db->where('user_id',$uid);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_user_courses($uid)
    {
        $this->db->select('Courses.course_unique, Courses.title');
        $this->db->from('Courses');
        $this->db->join('Course_User','Courses.course_unique = Course_User.course_unique');
        $this->db->join('User','Course_User.user_id = User.user_id');
        $this->db->where('User.user_id',$uid);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function add_course($uid,$cid)
    {
        $data = array(
       'course_unique' => $cid ,
       'user_id' => $uid
        );

        $this->db->insert('Course_User', $data);
        return TRUE;
    }
    
    public function remove_course($uid,$cid)
    {
        $this->db->where('course_unique', $cid);
        $this->db->where('user_id', $uid);
        $this->db->delete('Course_User');
        return True;
    }
    
    public function login_check($uid, $pass)
    {
        $this->db->select('*');
        $this->db->from('User');
        $this->db->where('user_id', $uid);
        $this->db->where('password', $pass);
        $query = $this->db->get();
        $tquery = $query->result_array();
        
        if(empty($tquery))
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
}
?>
