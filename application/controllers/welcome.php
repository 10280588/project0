<?php

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('templates/header', array('title' => 'CS164'));
		$this->load->view('welcome/index');
		$this->load->view('templates/footer');
	}
}

?>

