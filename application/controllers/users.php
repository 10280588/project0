<?php
class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('courses_model');
		$this->load->model('users_model');
	}

	public function login()
	{
	    $this->load->helper('form');
	    $this->load->library('form_validation');	    
	    $this->form_validation->set_rules('student_number', 'Student Number', 'required');
	    $this->form_validation->set_rules('password', 'Password', 'required');
	    
	    if ($this->form_validation->run() === FALSE)
	    {
    		$this->load->view('templates/header');
		    $this->load->view('pages/login_view');
		    $this->load->view('templates/footer');
	    }
	    else
	    {
	        $uid = $this->input->post('student_number');
	        $pass = $this->input->post('password');
	        $loginCheck = $this->users_model->login_check($uid,sha1($pass));
	        
	        if($loginCheck = TRUE)
	        {
	            $this->users_model->create_uid_cookie($uid);
	            $this->load->view('pages/home_view');
	        }
		    else
		    {
        		$this->load->view('templates/header');
		        $this->load->view('pages/login_view');
		        $this->load->view('templates/footer');
		    }
		}
	}
}

