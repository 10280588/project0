<?php
class Home extends CI_Controller {



	public function index()
	{
	    $this->load->helper('url');
	    $this->load->helper('login');
	    if_not_logged_in_redirect();
		$this->load->view('templates/header');
		$this->load->view('pages/home_view');
		$this->load->view('templates/footer');
	}

}


