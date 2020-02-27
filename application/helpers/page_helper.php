<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

if (!function_exists('debug')) {
	function debug()
	{
		array_map(function ($data) {
			dump($data);
		}, func_get_args());
		die;
	}
}
