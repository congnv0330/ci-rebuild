<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Language extends CI_Controller
{
	public function change($language = '')
	{
		$language = ($language != '') ? $language : 'vietnamese';
		$this->session->set_userdata('site_lang', $language);
		redirect($_SERVER['HTTP_REFERER']);
	}

}
