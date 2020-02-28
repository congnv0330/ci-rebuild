<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;

class Api
{
	protected $ci;

	public function __construct()
	{
		$this->ci =& get_instance();
	}

	public function get($uri, $params = array())
	{
		return $this->request('GET', $uri, $params);
	}

	public function post($uri, $params = array())
	{
		return $this->request('POST', $uri, $params);
	}

	public function request($method, $uri, $params = array())
	{
		try {
			$headers['Content-Type'] = 'application/json';
			if ($this->ci->session->has_userdata('token')) {
				$headers['x-access-token'] = $this->ci->session->userdata('token');
			}

			$client = new Client([
				'base_uri' => $this->ci->config->item('linkAPI'),
				'headers' => $headers
			]);

			$response = $client->request($method, $uri, $params);
			return $this->handleResponse(json_decode($response->getBody(), 1));
		} catch (ConnectException $e) {
			return $this->handleResponse(['exitcode' => 500]);
		}
	}

	protected function handleResponse($response)
	{
		if (isset($response['exitcode']) && $response['exitcode'] !== 1) {
			return [
				'error' => true,
				'message' => $this->ci->lang->line('exitcode_' . $response['exitcode'])
			];
		}

		return $response['data'];
	}
}
