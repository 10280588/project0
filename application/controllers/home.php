<?php
class Home extends CI_Controller {

	

	public function index()
	{
	    $this->load->helper('url');
	    $this->load->helper('login');
	    $logged_in = check_logged_in();
	    if($logged_in === TRUE)
	    {
		$this->load->view('templates/header');
		$this->load->view('pages/home_view');
	
	
		$this->load->view('templates/footer');
		}
	}
	
}


