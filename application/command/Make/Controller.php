<?php

namespace Command\Script\Make;

use Command\Script\Handler\Handler;

/**
 *
 */
class Controller
{
	/**
	 * Contain Handle instance Object
	 *
	 * @var Handler
	 */
	private $handle;

	/**
	 * Base folder for application
	 *
	 * @var string
	 */
	private $baseFolder = 'application/controllers/';

	/**
	 * Controller constructor.
	 */
	public function __construct()
	{
		$this->handle = new Handler();
	}

	/**
	 * Create file
	 *
	 * @param $name
	 */
	public function create($name)
	{
		$this->handle->make('controller', $this->baseFolder . $name);
	}
}
