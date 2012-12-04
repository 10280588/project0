<?php
class Courses_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_courses()
    {
        $this->db->select('title,course_unique');
		$query = $this->db->get('Courses');
		return $query->result_array();
    }
    
    public function get_departments()
    {
		$query = $this->db->get('Departments');
		return $query->result_array();
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
    
    public function get_course($id)
    {
        $this->db->select('*');
        $this->db->from('Courses');
        $this->db->join('Course_Department','Courses.course_unique = Course_Department.course_unique');
        $this->db->join('Department','Course_Department.dept_number = Department.dept_number');
        $this->db->join('Course_Faculty','Courses.course_unique = Course_Faculty.course_unique', 'left');
        $this->db->join('Faculty','Course_Faculty.facl_number = Faculty.facl_number', 'full');
        $this->db->join('Schedule','Courses.course_unique = Schedule.course_unique','left');
        $this->db->where('Courses.course_unique', $id);
		$query = $this->db->get();
		return $query->result_array();
    }
    
    public function get_search($slug)
    {
        if(str_word_count($slug, 0, 'àáãâäåçèéêëìíîïðñòóôõöùúûüýÿ1234567890') != 1) 
        {
            $slugPieces = str_word_count($slug, 1, 'àáãâäåçèéêëìíîïðñòóôõöùúûüýÿ1234567890');
            foreach ($slugPieces as $slugPiece)
            {
                $this->db->select('facl_number');
                $this->db->like('first_name', $slug);
                $this->db->or_like('middle_name', $slug);
                $this->db->or_like('last_name', $slug);
                $facl_number = $this->db->get('Faculty');
                
                foreach ($facl_number as $facl)
                {
                    $this->db->select('course_uniquen');
                    $this->db->where('facl_number',$facl_number);
                    $course_uniques = $this->db->get('Course_Faculty');
                }
                
                $this->db->like('title', $slug);
                $this->db->or_like('cat_num', $slug); 
                $this->db->or_like('description', $slug);
                foreach ($course_uniques as $course_unique)
                {
                    $this->db->or_like('course_unique', $course_unique);
                }
		        $query = $this->db->get('Courses');
		        return $query->result_array();
            }
        }
        else
        {
            $this->db->select('facl_number');
            $this->db->like('first_name', $slug);
            $this->db->or_like('middle_name', $slug);
            $this->db->or_like('last_name', $slug);
            $facl_number = $this->db->get('Faculty');
            
            foreach ($facl_number as $facl)
            {
                $this->db->select('course_unique');
                $this->db->where('facl_number',$facl_number);
                $course_uniques = $this->db->get('Course_Faculty');
            }
            
            $this->db->like('title', $slug);
            $this->db->or_like('cat_num', $slug); 
            $this->db->or_like('description', $slug);
            foreach ($course_uniques as $course_unique)
            {
                $this->db->or_like('course_unique', $course_unique);
            }
	        $query = $this->db->get('Courses');
	        return $query->result_array();
		}
    }
}
?>
