<?php
/**
* Bitrix Framework
* @package bitrix
* @subpackage security
* @copyright 2001-2013 Bitrix
*/

namespace lib;


use lib\Exception\Element\NotFound;

class DataBase
	extends \PDO
{
	const DEFAULT_FETCH_MODE = \PDO::FETCH_ASSOC;
	/** @var \PDO $instance */
	private static $instance = null;

	public function __construct ($dsn, $username = "", $passwd = "", $options = array())
	{
		parent::__construct($dsn, $username, $passwd, $options);
		$this->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, self::DEFAULT_FETCH_MODE);
	}

	public static function getInstance()
	{
		if(!self::$instance)
			self::$instance = self::instanceFromConfig();

		return self::$instance;
	}

	public static function instanceFromConfig()
	{
		$configs = Config::getInstance()->db();
		switch ($configs->Type) {
			case "Mysql":
					$dsn = "mysql:host=".$configs->Host.";dbname=".$configs->DBName.";";
				break;
			case "MSSQL":
					$dsn = "mssql:host=".$configs->Host.";dbname=".$configs->DBName.";";
				break;
			case "Oracle":
					$dsn = "oci:dbname=".$configs->DBName.";";
				break;
			default:
				throw new NotFound(sprintf("Unsuported DataBase engine '%s'", $configs->Type));
		}

		return new DataBase($dsn,$configs->User, $configs->Password);
	}

}