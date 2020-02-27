<?php
if ( ! defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class LanguageLoader
{
	function initialize()
	{
		$ci =& get_instance();

		$ci->load->helper('language');

		$siteLang = $ci->session->userdata('site_lang');
		$siteLang = ($siteLang) ? $siteLang : 'vietnamese';

		$ci->lang->load('Exit_code', $siteLang);
	}
}
