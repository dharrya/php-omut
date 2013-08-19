<?php
namespace lib\Item;

use lib\Exception\Item\ItemNotFound;

class NullWebItem
	extends WebItem
{
	protected $isExist = false;

	public function __construct() {}

	/**
	 * Delegate method calls to the Selenium Element
	 *
	 * @param  string $command
	 * @param  array $arguments
	 * @throws \lib\Exception\Item\ItemNotFound
	 * @return mixed
	 */
	public function __call($command, $arguments)
	{
		throw new ItemNotFound('Trying use a non-existent object');
	}

	/**
	 * @param bool $isExist
	 */
	public function setExist($isExist = true)
	{
		$this->isExist = false;
	}
} 