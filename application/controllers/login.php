<?php
class Login extends CI_Controller {

	

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('pages/login_view');
		$this->load->view('templates/footer');
	}
	
}


