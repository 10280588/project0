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
        $this->db->select('short_name,dept_number');
		$query = $this->db->get('Departments');
		return $query->result_array();
    }
    
    public function get_department($id)
    {
        $this->db->select('Courses.title,Courses.course_unique,Department.short_name');
        $this->db->from('Courses');
        $this->db->join('Course_Department','Courses.course_unique = Course_Department.course_unique');
        $this->db->join('Department','Course_Department.dept_number = Department.dept_number');
        $this->db->where('Department.dept_number', $id);
		$query = $this->db->get();
		return $query->result_array();
    }
    
    public function get_course($id)
    {
        $this->db->select('*');
        $this->db->from('Courses');
        $this->db->join('Course_Department','Courses.course_unique = Course_Department.course_unique');
        $this->db->join('Department','Course_Department.dept_number = Department.dept_number');
        $this->db->where('Courses.course_unique', $id);
		$query = $this->db->get();
		return $query->result_array();
    }
    
    public function get_course_facl($id)
    {
        $this->db->select('*');
        $this->db->from('Faculty');
        $this->db->join('Course_Faculty','Faculty.facl_number = Course_Faculty.facl_number', 'left');
        $this->db->where('Course_Faculty.course_unique', $id);
		$query = $this->db->get();
		return $query->result_array();
    }
    
    public function get_course_schedule($id)
    {
        $this->db->select('*');
        $this->db->from('Schedule');
        $this->db->join('Term','Schedule.term_number = Term.term_number', 'left');
        $this->db->join('Day','Schedule.day = Day.day_number');
        $this->db->where('Schedule.course_unique', $id);
		$query = $this->db->get();
		return $query->result_array();
    }
    
    public function get_course_location($id)
    {
        $this->db->select('*');
        $this->db->from('Location');
        $this->db->where('course_unique', $id);
		$query = $this->db->get();
		return $query->result_array();
    }
    
    public function get_and_search($slug)
    {   
        $totalQuery = array();
        $resultQuery = array();
            
        if(str_word_count($slug, 0, 'àáãâäåçèéêëìíîïðñòóôõöùúûüýÿ1234567890') != 1) 
        {
            $slugPieces = str_word_count($slug, 1, 'àáãâäåçèéêëìíîïðñòóôõöùúûüýÿ1234567890');
            
            $this->db->select('Courses.course_unique, Courses.title');
            $this->db->from('Courses');
            $this->db->join('Course_Faculty','Courses.course_unique = Course_Faculty.course_unique');
            $this->db->join('Faculty','Course_Faculty.facl_number = Faculty.facl_number');
            
            foreach ($slugPieces as $slugPiece)
            {
                $this->db->like('title', $slugPiece);
            }
            
            $this->db->order_by('course_unique','asc');
            $query = $this->db->get();
            $totalQuery = $query->result_array();
            
            foreach($totalQuery as $tQuery)
            {
                $i = FALSE;
                
                foreach($resultQuery as $rQuery)
                {
                    if($tQuery['course_unique'] == $rQuery['course_unique'])
                    {
                    $i=TRUE;
                    }
                }
                
                if($i === FALSE)
                {
                    array_push($resultQuery, $tQuery);
                }                
            }
        }
        
        else
        {
            $this->db->select('Courses.course_unique, Courses.title');
            $this->db->from('Courses');
            $this->db->join('Course_Faculty','Courses.course_unique = Course_Faculty.course_unique');
            $this->db->join('Faculty','Course_Faculty.facl_number = Faculty.facl_number');
            $this->db->like('title', $slug);
            $this->db->order_by('course_unique','asc');
	        $query = $this->db->get();
	        $totalQuery = $query->result_array();
	        foreach($totalQuery as $tQuery)
            {
                $i = FALSE;
                foreach($resultQuery as $rQuery)
                {
                    if($tQuery['course_unique'] == $rQuery['course_unique'])
                    {
                    $i=TRUE;
                    }
                }
                if($i === FALSE)
                {
                    array_push($resultQuery, $tQuery);
                }
            }
	    }
	    
        return $resultQuery;		
    }
    
    public function get_or_search($slug)
    {   
        $totalQuery = array();
        $resultQuery = array();
            
        if(str_word_count($slug, 0, 'àáãâäåçèéêëìíîïðñòóôõöùúûüýÿ1234567890') != 1) 
        {
            $slugPieces = str_word_count($slug, 1, 'àáãâäåçèéêëìíîïðñòóôõöùúûüýÿ1234567890');
            foreach ($slugPieces as $slugPiece)
            {
                $this->db->select('Courses.course_unique, Courses.title');
                $this->db->from('Courses');
                $this->db->join('Course_Faculty','Courses.course_unique = Course_Faculty.course_unique');
                $this->db->join('Faculty','Course_Faculty.facl_number = Faculty.facl_number');
                $this->db->like('title', $slugPiece);
                $this->db->order_by('course_unique','asc');
	            $query = $this->db->get();
	            $totalQuery = array_merge($totalQuery, $query->result_array());
            }
            
            foreach($totalQuery as $tQuery)
            {
                $i = FALSE;
                
                foreach($resultQuery as $rQuery)
                {
                    if($tQuery['course_unique'] == $rQuery['course_unique'])
                    {
                    $i=TRUE;
                    }
                }
                
                if($i === FALSE)
                {
                    array_push($resultQuery, $tQuery);
                }                
            }
        }
        
        else
        {
            $this->db->select('Courses.course_unique, Courses.title');
            $this->db->from('Courses');
            $this->db->join('Course_Faculty','Courses.course_unique = Course_Faculty.course_unique');
            $this->db->join('Faculty','Course_Faculty.facl_number = Faculty.facl_number');
            $this->db->like('title', $slug);
            $this->db->order_by('course_unique','asc');
	        $query = $this->db->get();
	        $totalQuery = $query->result_array();
	        foreach($totalQuery as $tQuery)
            {
                $i = FALSE;
                
                foreach($resultQuery as $rQuery)
                {
                    if($tQuery['course_unique'] == $rQuery['course_unique'])
                    {
                        $i=TRUE;
                    }
                }
                if($i === FALSE)
                {
                    array_push($resultQuery, $tQuery);
                }
            }
	    }
	    
        return $resultQuery;		
    }
}
?>
