<?php
class Courses extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('courses_model');
		$this->load->helper('url');
		
	}

	public function index()
	{
		$data['courses'] = $this->courses_model->get_courses();
		$this->load->view('templates/header');
		$this->load->view('pages/list_view', $data);
		$this->load->view('templates/footer');
	}

	public function course($id = FALSE)
	{
	    if($id === FALSE)
	    {
	            show_404();
	    }
	    
		$data['courses'] = $this->courses_model->get_course($id);
		$data['faculty'] = $this->courses_model->get_course_facl($id);
		$data['schedule'] = $this->courses_model->get_course_schedule($id);
	    $data['locations'] = $this->courses_model->get_course_location($id);
		
		
		$this->load->view('templates/header');
		$this->load->view('pages/individual_view', $data);
		$this->load->view('templates/footer');
	}
	
	public function searchresult()
	{
	    $slug = $this->input->get('searchHome');
	    $operator = $this->input->get('operator');
	    
	    if($operator === FALSE)
	    {
	        $operator = 'and';
	    }
	    
	    if($slug === FALSE)
	    {
	        $data['results'] = $this->courses_model->get_courses();
	    }
	    else
	    {
	        if($operator === 'and')
	        {
		        $data['results'] = $this->courses_model->get_and_search($slug);
		    }
		    elseif($operator === 'or')
		    {
		        $data['results'] = $this->courses_model->get_or_search($slug);
		    }
		    else
		    {
		        show_404();
		    }
		}
		$this->load->view('templates/header');
		$this->load->view('pages/list_search_result_view', $data);
		$this->load->view('templates/footer');
	}	
	
	public function search()
	{
	    $totalArray = array();
	    $search = $this->input->get('searchHome');
	    $keywords = str_word_count($search, 1, 'àáãâäåçèéêëìíîïðñòóôõöùúûüýÿ1234567890');
        $operator = $this->input->get('operator');
        $facultyCheck = $this->input->get('faculty_check');
        $titleCheck = $this->input->get('title_check');
        $descriptionCheck = $this->input->get('description_check');
        
	    $beginTime = $this->input->get('begin_time');
        $endTime = $this->input->get('end_time');
        
        $department = $this->input->get('department');
        $gened = $this->input->get('gened');
        
        if($facultyCheck != FALSE)
        {
            $facultyArray = $this->courses_model->get_search($keywords, 'faculty', $operator);
            $totalArray = $this->courses_model->merge_courses_xor($totalArray, $facultyArray);
        }
        
        if($titleCheck != FALSE)
        {
            $titleArray = $this->courses_model->get_search($keywords, 'title', $operator);
            $totalArray = $this->courses_model->merge_courses_xor($totalArray, $titleArray);
        }
        
        if($descriptionCheck != FALSE)
        {
            $descriptionArray = $this->courses_model->get_search($keywords, 'description', $operator);
            $totalArray = $this->courses_model->merge_courses_xor($totalArray, $descriptionArray);
        }
        
        if($beginTime != FALSE or $endTime != FALSE)
        {
            if($beginTime != FALSE and $endTime != FALSE)
            {
                $timeArray = $this->courses_model->search_time($beginTime, $endTime);
                $totalArray = $this->courses_model->merge_courses_and($totalArray, $timeArray);
            }
            
            elseif($beginTime != FALSE and $endTime == FALSE)
            {
                $timeArray = $this->courses_model->search_time($beginTime, 2400);
                $totalArray = $this->courses_model->merge_courses_and($totalArray, $timeArray);
            }
            
            elseif($beginTime == FALSE and $endTime != FALSE)
            {
                $timeArray = $this->courses_model->search_time(0, $endTime);
                $totalArray = $this->courses_model->merge_courses_and($totalArray, $timeArray);
            }
        }
        
        if($department != FALSE)
        {
            $departmentArray = $this->courses_model->get_department($department);
            $totalArray = $this->courses_model->merge_courses_and($totalArray, $departmentArray);
        }
        
        if($gened != FALSE)
        {
            $genedArray = $this->courses_model->get_gened($gened);
            $totalArray = $this->courses_model->merge_courses_and($totalArray, $genedArray);
        }
        
	    $data['courses'] = $totalArray;
	    $this->load->view('templates/header');
		$this->load->view('pages/list_search_result_view', $data);
		$this->load->view('templates/footer');       
	}
	
	
}


