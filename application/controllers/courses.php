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
		$this->load->view('templates/header');
		$this->load->view('pages/individual_view', $data);
		$this->load->view('templates/footer');
	}
}

