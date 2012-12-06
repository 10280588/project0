<?php
class Courses extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('courses_model');
		
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
	    $slug = $this->input->post('searchHome');
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
		$this->load->view('templates/header');
		$this->load->view('pages/list_search_result_view', $data);
		$this->load->view('templates/footer');
	}	
	
	
}


in de inspector van chrome zie jedat de css niet wordt ingeladen :S
