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
	    if_not_logged_in_redirect();
		$data['results'] = $this->courses_model->get_courses();
		$data['pageTitle'] = 'All Courses';
		$this->load->view('templates/header');
		$this->load->view('pages/list_view', $data);
		$this->load->view('templates/footer');
	}

	public function course($id = FALSE)
	{
	    if_not_logged_in_redirect();
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
	    if_not_logged_in_redirect();
	    $data['results'] = $this->courses_model->get_departments();
	    $data['pageTitle'] = 'Departments';
	    $this->load->view('templates/header');
		$this->load->view('pages/list_view', $data);
		$this->load->view('templates/footer');	    
	}
	
	public function department($id = FALSE)
	{
	    if_not_logged_in_redirect();
	    
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
	    if_not_logged_in_redirect();
	    $data['results'] = $this->courses_model->get_gened_areas();
	    $data['pageTitle'] = 'Gen Ed Areas';
	    $this->load->view('templates/header');
		$this->load->view('pages/list_view', $data);
		$this->load->view('templates/footer');	    
	}
	
	public function gened_area($id = FALSE)
	{
	    if_not_logged_in_redirect();
	    
	    if($id === FALSE)
	    {
	            show_404();
	    }
	    
		$data['results'] = $this->courses_model->get_gened_area($id);
		$data['pageTitle'] = $this->courses_model->get_gened_name($id);
		
		$this->load->view('templates/header');
		$this->load->view('pages/list_view', $data);
		$this->load->view('templates/footer');			
	}
	
	public function search()
	{
	    if_not_logged_in_redirect();
	    $tryArray = array();
	    $totalArray = array();
	    $search = $this->input->get('searchHome');
	    $keywords = str_word_count($search, 1, 'àáãâäåçèéêëìíîïðñòóôõöùúûüýÿ1234567890');
        $facultyCheck = $this->input->get('faculty_check');
        $titleCheck = $this->input->get('title_check');
        $descriptionCheck = $this->input->get('description_check');        
        $day = $this->input->get('day');
	    $beginTime = $this->input->get('begin_time');
        $endTime = $this->input->get('end_time');        
        $department = $this->input->get('department');
        $gened = $this->input->get('gened');
        
        $totalArray = $this->courses_model->get_search($totalArray, $keywords, 'faculty', $facultyCheck);
        $totalArray = $this->courses_model->get_search($totalArray, $keywords, 'title', $titleCheck);
        $totalArray = $this->courses_model->get_search($totalArray, $keywords, 'description', $descriptionCheck);
            
        if(($facultyCheck === FALSE) && ($titleCheck === FALSE) && ($descriptionCheck === FALSE))
        {
            $totalArray = $this->courses_model->search_day($totalArray, $day, 'or');
        }
        else
        {
            $totalArray = $this->courses_model->search_day($totalArray, $day, 'and');
        }
                     
        if(($facultyCheck === FALSE) && ($titleCheck === FALSE) && ($descriptionCheck === FALSE) && ($day == 'all'))
        {
            $totalArray = $this->courses_model->search_time($totalArray, $beginTime, $endTime, 'or');
        }
        else
        {
            $totalArray = $this->courses_model->search_time($totalArray, $beginTime, $endTime, 'and');
        }
        
        if($department !== 'all')
        {
            $departmentArray = $this->courses_model->get_department($department);
            if(($facultyCheck === FALSE) && ($titleCheck === FALSE) && ($descriptionCheck === FALSE) && ($day == 'all') && ($beginTime == 'all' && $endTime == 'all'))
            {
                $totalArray = merge_courses($totalArray, $departmentArray, 'or');
            }
            else
            {
                $totalArray = merge_courses($totalArray, $departmentArray, 'and');
            }
        }
        
        if($gened !== 'all')
        {
            $genedArray = $this->courses_model->get_gened_area($gened);
            if(($facultyCheck === FALSE) && ($titleCheck === FALSE) && ($descriptionCheck === FALSE) && ($day == 'all') && ($beginTime == 'all' && $endTime == 'all') && ($department == 'all'))
            {
                $totalArray = merge_courses($totalArray, $genedArray, 'or');
            }
            else
            {
                $totalArray = merge_courses($totalArray, $genedArray, 'and');
            }         
        }
        
        usort($totalArray, 'alfabetize_courses');
	    $data['results'] = $totalArray;
	    $data['pageTitle'] = 'Search Results';
	    $this->load->view('templates/header');
		$this->load->view('pages/list_view', $data);
		$this->load->view('templates/footer');      
	}
	
	public function advanced_search()
	{
	    if_not_logged_in_redirect();
	    $data['departments'] = $this->courses_model->get_departments(); 
	 	$data['geneds'] = $this->courses_model->get_gened_areas(); 
	 	$this->load->view('templates/header');
		$this->load->view('pages/advanced_search_view', $data);
		$this->load->view('templates/footer');
	}
}


