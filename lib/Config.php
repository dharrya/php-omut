<?php
/**
* Bitrix Framework
* @package bitrix
* @subpackage security
* @copyright 2001-2013 Bitrix
*/

namespace lib;


use lib\Exception\ConfigNotFound;

class Config {

	const CONFIG_DB = "DB";
	const CONFIG_SITE = "Site";
	const DEFAULT_CONFIGS = '{
		"DB": {
			"Type": "Mysql",
			"Host": "localhost:3306",
			"DBName": "",
			"User": "root",
			"Password": ""
		},
		"Site": {
			"Url": "http://localhost/",
			"UserName": "",
			"Password": ""
		}
	}';
	const DEFAULT_FILE_PATH = 'env.json';
	protected static $instance = null;

	/** @var \stdClass $configs  */
	protected $configs = null;

	private function __construct()
	{
		$this->configs = new \stdClass();
		if (file_exists(self::DEFAULT_FILE_PATH) && is_file(self::DEFAULT_FILE_PATH))
			$this->configs = json_decode(file_get_contents(self::DEFAULT_FILE_PATH));
		else
			$this->configs = json_decode(self::DEFAULT_CONFIGS);
	}

	public function db()
	{
		return $this->getConfig(self::CONFIG_DB);
	}

	public function site()
	{
		return $this->getConfig(self::CONFIG_SITE);
	}

	public function getConfig($type)
	{
		if (!isset($this->configs->$type))
			throw new ConfigNotFound("Config entry '{$type}' not present in configuration or not loaded propertly");

		return $this->configs->$type;
	}

	public function initFromJson($configString)
	{
		$this->configs = json_decode($configString);
	}

	public static function getInstance()
	{
		if(is_null(self::$instance))
		{
			self::$instance = new Config();
		}
		return self::$instance;
	}

	private function __clone() {}
	private function __wakeup() {}
}