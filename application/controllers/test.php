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
		$this->load->view('test_view', $data);
	}
	
}

