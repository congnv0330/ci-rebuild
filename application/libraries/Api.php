<?php
if ( ! defined('BASEPATH')) {
	exit('No direct script access allowed');
}

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;

class Api
{
	protected $client;

	public function __construct($config = array())
	{
		$this->client = new Client([
			'base_uri' => (isset($config['baseUrl'])) ? $config['baseUrl'] : '',
			'header' => [
				'x-access-token' => (isset($_SESSION['token'])) ? $_SESSION['token'] : ''
			]
		]);
	}

	public function request($method, $uri, $params = array())
	{
		try {
			$response = $this->client->request($method, $uri, $params);
			return $this->handleResponse(json_decode($response->getBody()));
		} catch (ConnectException $e) {
			return $this->handleResponse(['exitcode' => 503]);
		}
	}

	protected function handleResponse($response)
	{
		if (isset($response['exitcode'])) {
			$res = ['error' => true];

			if ($response['exitcode'] === 503) {
				$res['message'] = 'Service Unavailable';
			}

			return $res;
		}

		return $response;
	}

}
