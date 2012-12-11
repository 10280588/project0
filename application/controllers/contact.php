<?php
class Contact extends CI_Controller {

	

	public function index()
	{
	    $this->load->helper('url');
		$this->load->view('templates/header');
		$this->load->view('pages/contact_information_view');
		$this->load->view('templates/footer');
	}
	
}


