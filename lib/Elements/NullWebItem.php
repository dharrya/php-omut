<?php
namespace lib;

class NullWebItem
	extends WebItem
{
	protected $isExist = false;

	public function __construct()
	{

	}

	/**
	 * Delegate method calls to the Selenium Element
	 *
	 * @param  string $command
	 * @param  array $arguments
	 * @throws \lib\Exception\Element\NotFound
	 * @return mixed
	 */
	public function __call($command, $arguments)
	{
		throw new Exception\Element\NotFound('Trying use a non-existent object');
	}

	public function exists()
	{
		return $this->isExist;
	}

	public function setExist($isExist = true)
	{
		$this->isExist = false;
	}
} 