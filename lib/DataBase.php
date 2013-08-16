<?php
/**
* Bitrix Framework
* @package bitrix
* @subpackage security
* @copyright 2001-2013 Bitrix
*/

namespace lib;


class DataBase
	extends \PDO
{
	/** @var \PDO $instance */
	private static $instance = null;

	public static function getInstance()
	{
		if(!self::$instance)
			self::$instance = self::instanceFabric("mysql");

		return self::$instance;
	}

	public static function instanceFabric($type)
	{
		switch($type) {
			case "mysql":
				return new static("dsn");
			default:
				throw new \Exception(sprintf('DataBase type %s not found', $type));
		}
	}
} 