<?php
if ( ! defined('BASEPATH')) {
	exit('No direct script access allowed');
}

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;

class Api
{
	protected $ci;
	protected $client;

	public function __construct()
	{
		$this->ci =& get_instance();

		$header = array();
		if ($this->ci->session->has_userdata('token')) {
			$header['x-access-token'] = $this->ci->session->userdata('token');
		}

		$this->client = new Client([
			'base_uri' => $this->ci->config->item('linkAPI'),
			'header' => $header
		]);
	}

	public function request($method, $uri, $params = array())
	{
		try {
			$response = $this->client->request($method, $uri, $params);
			return $this->handleResponse(json_decode($response->getBody(), 1));
		} catch (ConnectException $e) {
			return $this->handleResponse(['exitcode' => 500]);
		}
	}

	protected function handleResponse($response)
	{
		if (isset($response['exitcode'])) {
			return [
				'error' => true,
				'message' => $this->ci->lang->line('exitcode_'.$response['exitcode'])
			];
		}

		return $response;
	}

}
