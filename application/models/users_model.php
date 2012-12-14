<?php
class Users_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
    
    public function create_uid_cookie($uid,$cookieCheck)
    {     
        if($cookieCheck === FALSE)
        {
            setcookie('uid', $uid, 0, '/');
        }
        else
        {
            setcookie('uid', $uid, time()+(3600*24*365), '/');
        }
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
        $this->db->order_by('Courses.title','asc');
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
        
        if(! empty($tquery))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function check_enrolled($uid,$cid)
    {
        $this->db->select('Courses.course_unique, Courses.title');
        $this->db->from('Courses');
        $this->db->join('Course_User','Courses.course_unique = Course_User.course_unique');
        $this->db->join('User','Course_User.user_id = User.user_id');
        $this->db->where('User.user_id',$uid);
        $this->db->where('Courses.course_unique',$cid);
        $query = $this->db->get();
        $resultArray = $query->result_array();
        if(empty($resultArray))
        {
            return 'no';
        }
        else
        {
            return 'yes';
        }
        
    }
    
    public function get_last_ten($uid)
    {
        $this->db->select('Recently_Viewed.course_unique, Courses.title');
        $this->db->from('Recently_Viewed');
        $this->db->join('Courses','Recently_Viewed.course_unique = Courses.course_unique');
        $this->db->where('Recently_Viewed.user_id',$uid);
        $this->db->order_by("time_viewed", "desc"); 
        $this->db->limit(10);
        $query = $this->db->get();
        return $query->result_array();
    }
        
        
    public function add_to_last_ten($uid,$cid) 
    {
        $this->db->select('*');
        $this->db->from('Recently_Viewed');
        $this->db->where('user_id', $uid);
        $this->db->where('course_unique', $cid);
        $query = $this->db->get();
        $getArray = $query->result_array();
        
        if(empty($getArray))
        {
            $data = array(
            'course_unique' => $cid ,
            'user_id' => $uid ,
            );
            
            $this->db->insert('Recently_Viewed', $data); 
        }
        else
        {
            $data = array(
            'time_viewed' => NULL ,
            );
            
            $this->db->where('user_id', $uid);
            $this->db->where('course_unique', $cid);
            $this->db->update('Recently_Viewed', $data); 
        }
    }
    
}
?>
