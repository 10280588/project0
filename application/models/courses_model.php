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
		$query = $this->db->get('Department');
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
    
    public function get_gened_areas()
    {
        $this->db->select('req_number,name');
		$this->db->from('Requirement');
		$this->db->where('type', 'General Education');
		$query = $this->db->get();
		return $query->result_array();
    }
    
    public function get_gened_area($gid)
    {
        $this->db->select('Courses.title,Courses.course_unique,Requirement.name');
		$this->db->from('Courses');
		$this->db->join('Course_Requirement','Courses.course_unique = Course_Requirement.course_unique');
		$this->db->join('Requirement','Course_Requirement.req_number = Requirement.req_number');
		$this->db->where('Requirement.req_number', $gid);
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
    
    public function get_search($keywords,$target,$operator)
    {        
        $this->db->select('Courses.course_unique, Courses.title');
        $this->db->from('Courses');
        
        if($target == 'faculty')
        {
            $this->db->join('Course_Faculty','Courses.course_unique = Course_Faculty.course_unique');
            $this->db->join('Faculty','Course_Faculty.facl_number = Faculty.facl_number');
        }
        
        foreach ($keywords as $keyword)
        {
            if($target == 'faculty')
            {
                if($operator == 'or')
                {
                    $this->db->or_like('(Faculty.first_name', $keyword);
                }
                else
                {
                    $this->db->like('(Faculty.first_name', $keyword);
                }
                $this->db->or_like('Faculty.middle_name', $keyword);
                $this->db->or_like('Faculty.last_name', $keyword);
                $this->db->bracket('close','like');
            }
            
            if($target == 'description')
            {
                if($operator == 'or')
                {
                    $this->db->or_like('Courses.description', $keyword);
                }
                else
                {
                    $this->db->like('Courses.description', $keyword);  
                }        
            }
            
            if($target == 'title')
            {
                if($operator == 'or')
                {
                    $this->db->or_like('Courses.title', $keyword); 
                }
                else
                {
                    $this->db->like('Courses.title', $keyword); 
                }         
            }
        }
        
        $this->db->order_by('course_unique','asc');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function search_day($day)
    {
        $this->db->select('Courses.course_unique,Courses.title');
        $this->db->from('Courses');
        $this->db->join('Schedule', 'Courses.course_unique = Schedule.course_unique');
        $this->db->where('day', $day);
        $query = $this->db->get();
        return $query->result_array();        
    }
    
    public function search_time($beginTime, $endTime)
    {
        $this->db->select('Courses.course_unique,Courses.title');
        $this->db->from('Courses');
        $this->db->join('Schedule', 'Courses.course_unique = Schedule.course_unique');
        $this->db->where('begin_time >=', $beginTime);
        $this->db->where('end_time <=', $endTime);
        $query = $this->db->get();
        return $query->result_array();        
    }
        
    public function merge_courses_xor($totalArray, $addArray)
    {
        foreach($addArray as $add)
        {
            $i = FALSE;
            
            foreach($totalArray as $total)
            {
                if($add['course_unique'] == $total['course_unique'])
                {
                    $i=TRUE;
                }
            }
            
            if($i === FALSE)
            {
                array_push($totalArray, $add);
            }                
        }
    
        return $totalArray;		
    }
    
    public function merge_courses_and($totalArray, $addArray)
    {
        foreach($addArray as $add)
        {
            $i = FALSE;
            
            foreach($totalArray as $total)
            {
                if($add['course_unique'] == $total['course_unique'])
                {
                    $i=TRUE;
                }
            }
            
            if($i === TRUE)
            {
                array_push($totalAndArray, $add);
            }                
        }
    
        return $totalAndArray;		
    }
}
?>
