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
    
    public function get_course($id)
    {
		$query = $this->db->get_where('Courses', array('course_unique' => $id));
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
