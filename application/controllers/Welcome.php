<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller
{
	public function index()
	{
		$this->load->model('User_model');
		debug($this->User_model->test());
		$this->load->view('welcome_message');
	}
}
