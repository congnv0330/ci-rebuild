<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class User_model extends MY_Model
{
	protected $table = '';

	public function test()
	{
		return $this->api->request('get', 'api/province/01/getAllDistrict');
	}
}
