<?php if ( ! defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class LanguageSwitcher extends CI_Controller
{
	function switchLang($language = '')
	{
		$language = ($language != '') ? $language : 'vietnamese';
		$this->session->set_userdata('site_lang', $language);

		redirect($_SERVER['HTTP_REFERER']);
	}

}
