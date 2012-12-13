<?php
class Test extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('courses_model');
		$this->load->model('users_model');
		$this->load->model('database_buildup_model');
	}

	public function courses()
	{
		$data['courses'] = $this->courses_model->get_courses();
		$this->load->view('test_view', $data);
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
		$this->load->view('test_view', $data);
	}
	
	public function department($id = FALSE)
	{
	    if($id === FALSE)
	    {
	        show_404();
	    }
	    
		$data['results'] = $this->courses_model->get_department($id);
		$this->load->view('test_view', $data);
	}
	
	public function gened($id = FALSE)
	{
	    if($id === FALSE)
	    {
	        show_404();
	    }
	    
		$data['results'] = $this->courses_model->get_gened_area($id);
		$this->load->view('test_view', $data);
	}
	
	public function search($search = FALSE, $target = FALSE, $operator = 'and')
	{
	    if($search === FALSE)
	    {
	        $data['results'] = $this->courses_model->get_courses();
	    }
	    else
	    {
	        $totalArray = array();
	        $keywords = str_word_count($search, 1, 'àáãâäåçèéêëìíîïðñòóôõöùúûüýÿ1234567890');
		    $searchArray = $this->courses_model->get_search($keywords, $target, $operator);
		    $data['results'] = $this->courses_model->merge_courses($totalArray, $searchArray);
		        
		}
		$this->load->view('test_view', $data);
	}
	
	public function timesearch($beginTime = FALSE, $endTime = FALSE)
	{
	    $totalArray = array();
	    
	    if($beginTime != FALSE and $endTime != FALSE)
            {
                $timeArray = $this->courses_model->search_time($beginTime, $endTime);
                $data['results'] = $this->courses_model->merge_courses($totalArray, $timeArray);
            }
            
            elseif($beginTime != FALSE and $endTime == FALSE)
            {
                $timeArray = $this->courses_model->search_time($beginTime, 2400);
                $data['results'] = $this->courses_model->merge_courses($totalArray, $timeArray);
            }
            
            elseif($beginTime == FALSE and $endTime != FALSE)
            {
                $timeArray = $this->courses_model->search_time(0, $endTime);
                $data['results'] = $this->courses_model->merge_courses($totalArray, $timeArray);
            }
            $this->load->view('test_view', $data);
	}
	
	public function searchresult()
	{
	    $slug = $this->input->post('keywords');
	    $operator = $this->input->post('operator');
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
		$this->load->view('test_view', $data);
	}
	
	public function departments()
	{
	    $data['results'] = $this->courses_model->get_departments();
	    $this->load->view('test_view', $data);
	}
	
	public function geneds()
	{
	    $data['results'] = $this->courses_model->get_gened_areas();
	    $this->load->view('test_view', $data);
	}
	
	public function rv_db()
	{
		$this->database_buildup_model->create_rv_table();
		$this->load->view('succes_view');
	}
	
}

