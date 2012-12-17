<?php
class Users extends CI_Controller {
    
    /********************************************************************
	*General information:  every function, except the constructor and   *
	*                      the 'login' function start by checking if the*
	*                      user is logged in by using the               *
	*                      'check_logged_in' function which can be found*
	*                      in the login_helper. This is done to prevent *
	*                      a not logged in user to use any functionality*
	*                      of the app except the login function.        *
	********************************************************************/

	public function __construct()
	{
		parent::__construct();
		$this->load->model('courses_model');
		$this->load->model('users_model');
        $this->load->helper('url');
        $this->load->helper('login');
	}
	
	/********************************************************************
	*function name: my_courses                                          *
	*arguments:     none                                                *
	*description:   gets the courses in which the logged in user is     *
	*               enrolled and loads the 'my_courses_view' to display *
	*               these courses.                                      *
	********************************************************************/
	public function my_courses()
	{
	    if_notlogged_in_redirect();
	    $uid = $this->input->cookie('uid');
	    $data['results'] = $this->users_model->get_user_courses($uid);
	    $data['functionSegment'] = 'course';
	    $data['pageTitle'] = 'My Courses';
	   	$this->load->view('templates/header');
	    $this->load->view('pages/list_view', $data);
	    $this->load->view('templates/footer');
	}

    /********************************************************************
	*function name: login                                               *
	*arguments:     none                                                *
	*description:   if user is not logged in this function will validate*
	*               the login form. if form is not passed correctly, the*
	*               login page is loaded again. if the form is passed   *
	*               correctly a cookie is made containing the user_id   *
	*               and then redirects to the home-page.                *
	*               if this function is called being logged in, it      *
	*               redirects to the home-page.                         *
	********************************************************************/
	public function login()
	{
	    if(isset($_COOKIE['uid']))
        { 
            redirect(home); 
        }
	    else
	    {
	        $uid = $this->input->cookie('uid');
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
	            $cookieCheck = $this->input->post('cookieCheck');
	            $loginCheck = $this->users_model->login_check($uid,sha1($pass));
	            
	            if($loginCheck == TRUE)
	            {
	                $cookieAnswer = $this->users_model->create_uid_cookie($uid,$cookieCheck);
	                redirect('home');
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
	
	/********************************************************************
	*function name: logout                                              *
	*arguments:     none                                                *
	*description:   deletes the 'uid' cookie and redirects to the login *
	*               page                                                *
	********************************************************************/
	public function logout()
	{
	    if_not_logged_in_redirect();
	    $this->users_model->delete_uid_cookie();
	    redirect('users/login');
	}
	
	/********************************************************************
	*function name: add_course                                          *
	*arguments:     $cid: course_unique of the course to be added to    *
	*               the user. boolean FALSE by default.                 *
	*description:   gets $uid (user_id) from the cookie. Checks if the  *
	*               user is already enrolled in this course, if not the *
	*               course is added to the users courses. the function  *
	*               then redirects back to the courses page.            *
	********************************************************************/
	public function add_course($cid = FALSE)
	{
	    if_not_logged_in_redirect();
	    $uid = $this->input->cookie('uid');
	    $enrolled = $this->users_model->check_enrolled($uid,$cid);
	    
	    if($cid === FALSE)
	    {
	        show_404();
	    }
	    
	    if($enrolled == 'no')
	    {
	        $this->users_model->add_course($uid,$cid);
	    }
	    
	    redirect('courses/course/'.$cid);
	}
	
	/********************************************************************
	*function name: remove_course                                       *
	*arguments:     $cid: course_unique of the course to be removed to  *
	*               the user. boolean FALSE by default.                 *
	*description:   gets $uid (user_id) from the cookie. removes the    *
	*               course from the users courses and redirects back to *
	*               the courses page.                                   *
	********************************************************************/
	public function remove_course($cid = FALSE)
	{
	    if_not_logged_in_redirect();
	    $uid = $this->input->cookie('uid');
	    
	    if($cid === FALSE)
	    {
	        show_404();
	    }
	    
	    $this->users_model->remove_course($uid,$cid);
	    redirect('courses/course/'.$cid);
	}
	
	/********************************************************************
	*function name: last_ten                                            *
	*arguments:     none                                                *
	*description:   gets $uid (user_id) from the cookie. gets the users *
	*               ten most recently viewed courses and loads the view *
	*               to display them.                                    *
	********************************************************************/
	public function last_ten()
	{
	    if_not_logged_in_redirect();
	    $uid = $this->input->cookie('uid');
	    $data['results'] = $this->users_model->get_last_ten($uid);
	    $data['functionSegment'] = 'course';
	    $data['pageTitle'] = 'Recently Viewed';
	   	$this->load->view('templates/header');
	    $this->load->view('pages/list_view', $data);
	    $this->load->view('templates/footer');
	
	}
}

