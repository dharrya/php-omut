<?php
namespace lib;

use lib\Exception\ConfigNotFound;

class Config
{
	const CONFIG_DB = "DB";
	const CONFIG_SITE = "Site";
	const CONFIG_BROWSER = "Browser";
	const DEFAULT_CONFIGS = '{
		"Browser": {
			"browserName": "firefox",
			"host": "localhost",
			"port": 4444,
			"browser": null,
			"desiredCapabilities": [],
			"seleniumServerRequestsTimeout": 60
		},
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
		$userConfigs = array();

		if (file_exists(self::DEFAULT_FILE_PATH) && is_file(self::DEFAULT_FILE_PATH)) {
			$userConfigs = json_decode(file_get_contents(self::DEFAULT_FILE_PATH), true);
		}

		$this->configs = array_merge(
			json_decode(self::DEFAULT_CONFIGS, true),
			$userConfigs
		);
	}

	/**
	 * @return mixed
	 */
	public function db()
	{
		return $this->getConfig(self::CONFIG_DB);
	}

	/**
	 * @return mixed
	 */
	public function browser()
	{
		return $this->getConfig(self::CONFIG_BROWSER);
	}

	/**
	 * @return mixed
	 */
	public function site()
	{
		return $this->getConfig(self::CONFIG_SITE);
	}

	/**
	 * @param string $type
	 * @return mixed
	 * @throws Exception\ConfigNotFound
	 */
	public function getConfig($type)
	{
		if (!isset($this->configs[$type]))
			throw new ConfigNotFound("Config entry '{$type}' not present in configuration or not loaded propertly");

		return $this->configs[$type];
	}

	/**
	 * @param string $configString
	 */
	public function initFromJson($configString)
	{
		$this->configs = json_decode($configString);
	}

	/**
	 * @return Config
	 */
	public static function getInstance()
	{
		if(!self::$instance)
			self::$instance = new Config();

		return self::$instance;
	}

	private function __clone() {}
	private function __wakeup() {}
}