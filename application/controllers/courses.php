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

	public function index($offset = 0)
	{
	    if_not_logged_in_redirect();
	    
	    $resultsPerPage = 250;
	    //start pagination config
	    $this->load->library('pagination');
        $config['base_url'] = site_url('courses/index');
        $config['total_rows'] = 5233;
        $config['per_page'] = $resultsPerPage;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['cur_tag_open'] = '<li>';
        $config['cur_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['num_links'] = 1;
        $config['display_pages'] = FALSE;
        $this->pagination->initialize($config);
        //end pagination config
        
        $data['links'] = $this->pagination->create_links();   
		$data['results'] = $this->courses_model->get_courses($offset);
		$pageNumber = ($offset/$resultsPerPage)+1;
		$data['pageTitle'] = 'All Courses '. $pageNumber;
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
		$this->users_model->limit_to_last_ten($uid);
		
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
            
        $op = 'and';
        if(($facultyCheck === FALSE) && ($titleCheck === FALSE) && ($descriptionCheck === FALSE))
        {
            $op = 'or';
        }
            
        $totalArray = $this->courses_model->search_day($totalArray, $day, $op);
                     
        if(($facultyCheck === FALSE) && ($titleCheck === FALSE) && ($descriptionCheck === FALSE) && ($day == 'all'))
        {
            $op = 'or';
        }
        
        $totalArray = $this->courses_model->search_time($totalArray, $beginTime, $endTime, $op);
        
        if($department !== 'all')
        {
            $departmentArray = $this->courses_model->get_department($department);
            if(($facultyCheck === FALSE) && ($titleCheck === FALSE) && ($descriptionCheck === FALSE) && ($day == 'all') && ($beginTime == 'all' && $endTime == 'all'))
            {
                $op = 'or';
            }
            
            $totalArray = merge_courses($totalArray, $departmentArray, $op);
        }
        
        if($gened !== 'all')
        {
            $genedArray = $this->courses_model->get_gened_area($gened);
            if(($facultyCheck === FALSE) && ($titleCheck === FALSE) && ($descriptionCheck === FALSE) && ($day == 'all') && ($beginTime == 'all' && $endTime == 'all') && ($department == 'all'))
            {
                $op = 'or';    
            }
            
            $totalArray = merge_courses($totalArray, $genedArray, $op);
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


