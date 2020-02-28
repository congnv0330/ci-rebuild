<?php

namespace Command\Script\Make;

use Command\Script\Handler\Handler;

/**
 *
 */
class Helper
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
	private $baseFolder = 'application/helpers/';

	/**
	 * Helper constructor.
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
		$this->handle->make('helper', $this->baseFolder . $name . '_helper');
	}
}
