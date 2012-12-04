<?php
class Test extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('courses_model');
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
		$this->load->view('test_view', $data);
	}
	
}

