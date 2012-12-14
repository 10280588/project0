<?php
class Courses extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('courses_model');
		$this->load->helper('url');
		$this->load->helper('login');
		$this->load->helper('courses');
		$this->load->model('users_model');	
	}

	public function index()
	{
	    check_logged_in();
		$data['results'] = $this->courses_model->get_courses();
		$data['functionSegment'] = 'course';
		$data['pageTitle'] = 'All Courses';
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
		$this->users_model->add_to_last_ten($uid, $id);
		
		$this->load->view('templates/header');
		$this->load->view('pages/individual_view', $data);
		$this->load->view('templates/footer');			
	}
	
	public function departments()
	{
	    check_logged_in();
	    $data['results'] = $this->courses_model->get_departments();
	    $data['functionSegment'] = 'department';
	    $data['pageTitle'] = 'Departments';
	    $this->load->view('templates/header');
		$this->load->view('pages/list_view', $data);
		$this->load->view('templates/footer');	    
	}
	
	public function department($id = FALSE)
	{
	    check_logged_in();
	    
	    if($id === FALSE)
	    {
	            show_404();
	    }
	    
		$data['results'] = $this->courses_model->get_department($id);
		$data['functionSegment'] = 'course';
		$data['pageTitle'] = $this->courses_model->get_department_name($id);
		
		$this->load->view('templates/header');
		$this->load->view('pages/list_view', $data);
		$this->load->view('templates/footer');			
	}
	
	public function gened_areas()
	{
	    check_logged_in();
	    $data['results'] = $this->courses_model->get_gened_areas();
	    $data['functionSegment'] = 'gened_area';
	    $data['pageTitle'] = 'Gen Ed Areas';
	    $this->load->view('templates/header');
		$this->load->view('pages/list_view', $data);
		$this->load->view('templates/footer');	    
	}
	
	public function gened_area($id = FALSE)
	{
	    check_logged_in();
	    
	    if($id === FALSE)
	    {
	            show_404();
	    }
	    
		$data['results'] = $this->courses_model->get_gened_area($id);
		$data['functionSegment'] = 'course';
		$data['pageTitle'] = $this->courses_model->get_gened_name($id);
		
		$this->load->view('templates/header');
		$this->load->view('pages/list_view', $data);
		$this->load->view('templates/footer');			
	}
	
	public function search()
	{
	    check_logged_in();
	    $tryArray = array();
	    $totalArray = array();
	    $search = $this->input->get('searchHome');
	    $keywords = str_word_count($search, 1, 'àáãâäåçèéêëìíîïðñòóôõöùúûüýÿ1234567890');
        $operator = $this->input->get('operator');
        $facultyCheck = $this->input->get('faculty_check');
        $titleCheck = $this->input->get('title_check');
        $descriptionCheck = $this->input->get('description_check');
        
        $day = $this->input->get('day');
	    $beginTime = $this->input->get('begin_time');
        $endTime = $this->input->get('end_time');
        
        $department = $this->input->get('department');
        $gened = $this->input->get('gened');
        
        if($operator === FALSE)
        {
            $operator = 'and';
            $data['operator'] = 'operator is false: '. $operator;       
        }
        
        if($facultyCheck !== FALSE)
        {
            $data['facultyCheck'] = 'faculty is niet false: '. $facultyCheck;
            $facultyArray = $this->courses_model->get_search($keywords, 'faculty', $operator);
            $totalArray = $this->courses_model->merge_courses_xor($totalArray, $facultyArray);
        }
        
        if($titleCheck !== FALSE)
        {
            $data['titleCheck'] = 'title is niet false: '. $titleCheck;
            $titleArray = $this->courses_model->get_search($keywords, 'title', $operator);
            $totalArray = $this->courses_model->merge_courses_xor($totalArray, $titleArray);
        }
        
        if($descriptionCheck !== FALSE)
        {
            $data['descriptionCheck'] = 'description is niet false: '. $descriptionCheck;
            $descriptionArray = $this->courses_model->get_search($keywords, 'description', $operator);
            $totalArray = $this->courses_model->merge_courses_xor($totalArray, $descriptionArray);
        }
        
        if($day !== 'all')
        {
            $data['day'] = 'day is niet false: '. $day;
            $dayArray = $this->courses_model->search_day($day);
            
            if(($facultyCheck === FALSE) && ($titleCheck === FALSE) && ($descriptionCheck === FALSE))
            {
                $totalArray = $this->courses_model->merge_courses_xor($totalArray, $dayArray);
            }
            else
            {
                $totalArray = $this->courses_model->merge_courses_and($totalArray, $dayArray);
            }
        }
        
        if($beginTime !== 'all' || $endTime !== 'all')
        {
            if($beginTime !== 'all' && $endTime !== 'all')
            {
                $data['time'] = 'begintime en endtime zijn niet false: '. $beginTime .' '. $endTime;
                $timeArray = $this->courses_model->search_time($beginTime, $endTime);
                
                if(($facultyCheck === FALSE) && ($titleCheck === FALSE) && ($descriptionCheck === FALSE) && ($day == 'all'))
                {
                    $totalArray = $this->courses_model->merge_courses_xor($totalArray, $timeArray);
                }
                else
                {
                    $totalArray = $this->courses_model->merge_courses_and($totalArray, $timeArray);
                }
            }
            
            elseif($beginTime !== 'all' && $endTime == 'all')
            {
                $data['beginTime'] = 'begintime is niet false en endtime wel: '. $beginTime .' '. $endTime;
                $timeArray = $this->courses_model->search_time($beginTime, 2400);
                
                if(($facultyCheck === FALSE) && ($titleCheck === FALSE) && ($descriptionCheck === FALSE) && ($day == 'all'))
                {
                    $totalArray = $this->courses_model->merge_courses_xor($totalArray, $timeArray);
                }
                else
                {
                    $totalArray = $this->courses_model->merge_courses_and($totalArray, $timeArray);
                }
            }
            
            elseif($beginTime == 'all' && $endTime !== 'all')
            {
                $data['endTime'] = 'begintime is false en endtime niet: '. $beginTime .' '. $endTime;
                $timeArray = $this->courses_model->search_time(0, $endTime);
                
                if(($facultyCheck === FALSE) && ($titleCheck === FALSE) && ($descriptionCheck === FALSE) && ($day == 'all'))
                {
                    $totalArray = $this->courses_model->merge_courses_xor($totalArray, $timeArray);
                }
                else
                {
                    $totalArray = $this->courses_model->merge_courses_and($totalArray, $timeArray);
                }         
            }
        }
        
        if($department !== 'all')
        {
            $data['department'] = 'department is niet false: '. $department;
            $departmentArray = $this->courses_model->get_department($department);
            if(($facultyCheck === FALSE) && ($titleCheck === FALSE) && ($descriptionCheck === FALSE) && ($day == 'all') && ($beginTime == 'all' && $endTime == 'all'))
            {
                $totalArray = $this->courses_model->merge_courses_xor($totalArray, $departmentArray);
            }
            else
            {
                $totalArray = $this->courses_model->merge_courses_and($totalArray, $departmentArray);
            }
        }
        
        if($gened !== 'all')
        {
            $data['gened'] = 'gened is niet false: '. $gened;
            $genedArray = $this->courses_model->get_gened_area($gened);
            if(($facultyCheck === FALSE) && ($titleCheck === FALSE) && ($descriptionCheck === FALSE) && ($day == 'all') && ($beginTime == 'all' && $endTime == 'all') && ($department == 'all'))
            {
                $totalArray = $this->courses_model->merge_courses_xor($totalArray, $genedArray);
            }
            else
            {
                $totalArray = $this->courses_model->merge_courses_and($totalArray, $genedArray);
            }         
        }
        
        usort($totalArray, 'alfabetize_courses');
	    $data['results'] = $totalArray;
	    $data['functionSegment'] = 'course';
	    $data['pageTitle'] = 'Search Results';
	    $this->load->view('templates/header');
		$this->load->view('pages/list_view', $data);
		$this->load->view('templates/footer');    
		//$this->load->view('test_view', $data);  
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


