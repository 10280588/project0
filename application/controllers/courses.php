<?php
class Courses extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('courses_model');
		$this->load->helper('url');
		$this->load->helper('login');
		$this->load->model('users_model');

		
	}

	public function index()
	{
	    check_logged_in();
		$data['courses'] = $this->courses_model->get_courses();
		$this->load->view('templates/header');
		$this->load->view('pages/list_view', $data);
		$this->load->view('templates/footer');
	}

	public function course($id = FALSE)
	{
	    check_logged_in();
	    $uid = $this->input->cookie('uid');
	    if($id === FALSE)
	    {
	            show_404();
	    }
	    
		$data['courses'] = $this->courses_model->get_course($id);
		$data['faculty'] = $this->courses_model->get_course_facl($id);
		$data['schedule'] = $this->courses_model->get_course_schedule($id);
	    $data['locations'] = $this->courses_model->get_course_location($id);
	    $data['enrolled'] = $this->users_model->check_enrolled($uid,$id);
		
		
		$this->load->view('templates/header');
		$this->load->view('pages/individual_view', $data);
		$this->load->view('templates/footer');
	}
	
	public function searchresult()
	{
	    check_logged_in();
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
	
	public function search_test()
	{
	    $totalArray = array();
	    $search = $this->input->post('searchHome');
	    $data['search'] = $this->input->post('searchHome');
	    $data['keywords'] = str_word_count($search, 1, 'àáãâäåçèéêëìíîïðñòóôõöùúûüýÿ1234567890');
        $data['operator'] = $this->input->post('operator');
        $data['facultyCheck'] = $this->input->post('faculty_check');
        $data['titleCheck'] = $this->input->post('title_check');
        $data['descriptionCheck'] = $this->input->post('description_check');
        
        $data['day'] = $this->input->post('day');
	    $data['beginTime'] = $this->input->post('begin_time');
        $data['endTime'] = $this->input->post('end_time');
        
        $data['department'] = $this->input->post('department');
        $data['gened'] = $this->input->post('gened');
        
        $this->load->view('test_view',$data);
	}
	
	public function search()
	{
	    check_logged_in();
	    $totalArray = array();
	    $search = $this->input->post('searchHome');
	    $keywords = str_word_count($search, 1, 'àáãâäåçèéêëìíîïðñòóôõöùúûüýÿ1234567890');
        $operator = $this->input->post('operator');
        $facultyCheck = $this->input->post('faculty_check');
        $titleCheck = $this->input->post('title_check');
        $descriptionCheck = $this->input->post('description_check');
        
        $day = $this->input->post('day');
	    $beginTime = $this->input->post('begin_time');
        $endTime = $this->input->post('end_time');
        
        $department = $this->input->post('department');
        $gened = $this->input->post('gened');
        
        if(($facultyCheck != FALSE) && ($titleCheck != FALSE) && ($descriptionCheck != FALSE))
        {
            $coursesArray = $this->courses_model->get_courses();
            $totalArray = $this->courses_model->merge_courses_xor($totalArray, $coursesArray);
        }
        
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
        
        if($day != FALSE)
        {
            $dayArray = $this->courses_model->search_day($day);
            $totalArray = $this->courses_model->merge_courses_and($totalArray, $dayArray);
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
        
	    $data['results'] = $totalArray;
	    $this->load->view('templates/header');
		$this->load->view('pages/list_search_result_view', $data);
		$this->load->view('templates/footer');       
	}
	
	public function advanced_search()
	{
	    check_logged_in();
	    $data['departments'] = $this->courses_model->get_departments(); 
	 	$data['geneds'] = $this->courses_model->get_gened_areas(); 
	 	$this->load->view('templates/header');
		$this->load->view('pages/advanced_search_view', $data);
		$this->load->view('templates/footer');
	}
}


