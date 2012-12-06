<?php
class NoFaculty_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	   
     public function set_faculty()
    {
        $this->db->select('course_unique');
        $this->db->from('Courses');
		$query = $this->db->get();
		$courses = $query->result_array();
		foreach($courses as $course)
		{
		    $this->db->select('*');
            $this->db->from('Course_Faculty');
            $this->db->where('course_unique',$course['course_unique']);
            $query2 = $this->db->get();
            $array2 = $query2->result_array();
            
            if(empty($array2))
            {
                $data = array(
                    'course_unique' => $course['course_unique'] ,
                    'facl_number' => '7246'
                );

                $this->db->insert('Course_Faculty', $data); 
            }            
		}
		
		return TRUE;
    }
}
?>
